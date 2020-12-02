<?php
class Event_model extends CI_Model
{
    public function createEvent($userId, $image)
    {//Créer un event
        $data['creator_id'] = $userId;
        $data['event_name'] = $this->input->post('event_name');
        $data['event_description'] = $this->input->post('event_description');
        $data['city_address'] = $this->input->post('city_address');
        $data['zip_code_address'] = $this->input->post('zip_code_address');
        $data['address'] = $this->input->post('address');
        $data['event_date'] = $this->input->post('event_date');
        $data['max_fees'] = $this->input->post('max_fees');

        if(strlen($image) > 0) {
            //Si une image a été upload, l'inclue aux data
            $data['event_picture'] = $image;    
        }        

        if($this->input->post('private')) {
            //Conversion des values checkbox en booléen
            $data['private'] = TRUE;
        } else {
            $data['private'] = FALSE;
        }

        if($this->input->post('mandatory_fees')) {
            //Conversion des values checkbox en booléen
            $data['mandatory_fees'] = TRUE;
        } else {
            $data['mandatory_fees'] = FALSE;
        }

        if($this->input->post('mandatory_needs')) {
            //Conversion des values checkbox en booléen
            $data['mandatory_needs'] = TRUE;
        } else {
            $data['mandatory_needs'] = FALSE;
        }

        $this->db->insert('event_plan', $data);

        $dataneeds['event_id'] = $this->db->insert_id();

        //Insère le créateur comme participant et cotisateur
        $part['user_id'] = $userId;
        $part['event_id'] = $this->db->insert_id();
        $part['authorized'] = TRUE;
        
        $fees['user_id'] = $userId;
        $fees['event_id'] = $this->db->insert_id();
        $fees['fees'] = 0;
        $this->db->insert('event_participants', $part);
        $this->db->insert('membership_fees', $fees);

        //Infos sur les besoins qui vont eux dans la table event_needs

        for($l=0; $l < count($this->input->post('need')); $l++){
            //Les inputs des besoins ont le même nom, donc on boucle la requête pour insérer chaques row de l'array

            if(strlen($this->input->post('need')[$l]) > 0) {
                //Si la value n'est pas vide
                $dataneeds['need_name'] = $this->input->post('need')[$l];
                $dataneeds['category'] = $this->input->post('category')[$l];
                $this->db->insert('event_needs', $dataneeds);
            }
        }
    }

    public function showEvent($id)
    {//Récupère toutes les infos d'un event
        $data = array();
        $this->db->select('*') -> from('event_plan') -> where(['event_id' => $id]);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEventNeeds($id)
    {//Récupère tous les besoins d'un event
        $data = array();
        $this->db->select('*') -> from('event_needs') -> where(['event_id' => $id]);
        $this->db->join('user', 'event_needs.supplier_id = user.id_user', 'left');
        $this->db->join('needs_category', 'needs_category.id_category = event_needs.category', 'left');
        $query = $this->db->get();
        return $query;
    }

    public function listEvent($offset) 
    {//Récupère tous les évènements PUBLICS
        $data = array();
        $this->db->select('*') -> from('event_plan') -> where(['private' => TRUE]) -> limit(10) -> offset($offset) -> order_by("event_id", "desc");
        $query = $this->db->get();
        return $query;
    }

    public function isParticipants($eventId, $userId, $authorized)
    {//Check si un user est participant d'un event ou non
        $data = array();
        $this->db->select('*') -> from('event_participants') -> where(['event_id' => $eventId, 'user_id' => $userId, 'authorized' => $authorized]);
        $query = $this->db->get();
        if($query->row() != null) {
            return (int) $query->num_rows();
        }
    }

    public function participantsList($id) 
    {//Récupère tous les participants d'un évènement et les infos associées (besoins et cotisations)
        $data = array();
        $this->db->select('*') -> from('event_participants') -> where(['event_participants.event_id' => $id, 'authorized'=> TRUE, 'membership_fees.event_id' => $id]);
        $this->db->join('user', 'event_participants.user_id = user.id_user', 'left');
        $this->db->join('membership_fees', 'membership_fees.user_id = event_participants.user_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function claimersList($id) 
    {//Récupère les participants en attente de validation du créateur de l'event
        $data = array();
        $this->db->select('*') -> from('event_participants') -> where(['event_participants.event_id' => $id, 'authorized'=> FALSE]);
        $this->db->join('user', 'event_participants.user_id = user.id_user', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function participantsRank($id) 
    {//Récupère les infos des participants pour connaitre leur rang (Createur dans event_plan et admin ou invité dans event_participants)
        $this->db->select('*') -> from('event_plan') -> where(['event_participants.event_id' => $id]);
        $this->db->join('event_participants', 'event_participants.event_id = event_plan.event_id', 'outter');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function participantsNeeds($id)
    {//Récupère les besoins d'un event
        $data = array();
        $this->db->select('*') -> from('event_needs') -> where(['event_id' => $id]);
        $this->db->join('needs_category', 'needs_category.id_category = event_needs.category', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function totalFees($id)
    {//Calcule la cotisation totale des participants d'un event
        $this->db->select_sum('fees') -> from('membership_fees') -> where(['event_id' => $id]);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function newFees($eventId, $userId)
    {//Nouvelle cotisation
        $data['user_id'] = $userId;
        $data['event_id'] = $eventId;
        $query = $this->db->select('*')
         -> from('membership_fees')
         -> where(['user_id' => $userId, 'event_id' => $eventId])
         -> get()
         -> result_array();

        if(empty($query)) {
            //si aucune cotisation n'existe de cet utilisateur, en créer une
            $data['fees'] = $this->input->post('new_fees');
            $this->db->insert('membership_fees', $data);
        } else {
            //Sinon, met à jour celle existante en additionant l'actuelle et la nouvelle
            $data['fees'] = $query[0]['fees'] + $this->input->post('new_fees');
            $this->db->where(['user_id' => $userId, 'event_id' => $eventId]);
            $this->db->update('membership_fees', $data);
        }
    }

    public function newSupplier($needId, $userId) 
    {//Indique un fournisseur à un besoin
        $data['supplier_id'] = $userId;
        $this->db->where('event_needs_id', $needId);
        $this->db->update('event_needs', $data);
    }

    public function removeSupplier($needId) 
    {//Retire un fournisseur
        $data['supplier_id'] = NULL;
        $this->db->where('event_needs_id', $needId);
        $this->db->update('event_needs', $data);
    }

    public function rank($eventId, $userId, $state) 
    {//Met à jour le rang d'un participant en fonction du param $state
        $data['super_user'] = $state;
        $this->db->where(['user_id' => $userId, 'event_id' => $eventId]);
        $this->db->update('event_participants', $data);
    }

    public function myEvents($id)
    {//Récupère tous les évènements dont l'user est créateur
        $this->db->select('*') -> from('event_plan') -> where(['creator_id' => $id]) -> order_by("event_id", "desc");
        $query = $this->db->get();
        return $query;
    }

    public function iParticipate($id)
    {//Récupère tous les évènements dont l'user est participant
        $this->db->select('*') -> from('event_participants') -> where(['user_id' => $id])  -> order_by("event_plan.event_id", "desc");
        $this->db->join('event_plan', 'event_plan.event_id = event_participants.event_id', 'inner');
        $query = $this->db->get();
        return $query;
    }

    public function deleteEvent($eventId, $userId)
    {//Supprime un event (Egalement utilisé pour le backoffice)
        $this->db->delete('event_plan', array('creator_id' => $userId, 'event_id' => $eventId));
    }

    public function editEvent($eventId, $userId, $image)
    {//Edition d'évèenement
        $data['creator_id'] = $userId;
        $data['event_name'] = $this->input->post('event_name');
        $data['event_description'] = $this->input->post('event_description');
        $data['city_address'] = $this->input->post('city_address');
        $data['zip_code_address'] = $this->input->post('zip_code_address');
        $data['address'] = $this->input->post('address');
        $data['event_date'] = $this->input->post('event_date');
        $data['max_fees'] = $this->input->post('max_fees');

        if(strlen($image) < 1 ) {
            //Si le créateur n'a pas ajouté de nouvelle image, récupère l'actuelle
            $data['event_picture'] = $this->input->post('actual_pic');
        } else {
            //Sinon prend la nouvelle
            $data['event_picture'] = $image;
            
            if($this->input->post('actual_pic') != 'default.jpg') {
                //Si l'image de l'event n'est pas celle attribuée par défault, supprime l'image actuelle et ajoute la nouvelle
                $actualpic = $this->input->post('actual_pic');
                unlink("assets/images/uploaded_images/$actualpic");
            }
        }
        
        if($this->input->post('private')) {
            //Conversion des values checkbox en booléen
            $data['private'] = TRUE;
        } else {
            $data['private'] = FALSE;
        }

        if($this->input->post('mandatory_fees')) {
            //Conversion des values checkbox en booléen
            $data['mandatory_fees'] = TRUE;
        } else {
            $data['mandatory_fees'] = FALSE;
        }

        if($this->input->post('mandatory_needs')) {
            //Conversion des values checkbox en booléen
            $data['mandatory_needs'] = TRUE;
        } else {
            $data['mandatory_needs'] = FALSE;
        }

        $this->db->where(['creator_id' => $userId, 'event_id' => $eventId]);
        $this->db->update('event_plan', $data);

        //Infos sur les besoins qui vont eux dans la table event_needs
        $dataneeds['event_id'] = $eventId;
        
        for($l=0; $l < count($this->input->post('need')); $l++){

            if(strlen($this->input->post('need')[$l]) > 0) {
                $dataneeds['need_name'] = $this->input->post('need')[$l];
                $dataneeds['category'] = $this->input->post('category')[$l];
                $this->db->insert('event_needs', $dataneeds);
            }
        }
    }

    public function isAdmin($eventId, $userId)
    {//Vérifie le rang de l'utilisateur sur l'event en question
        $this->db->select('super_user') -> from('event_participants') -> where(['event_id' => $eventId, 'user_id' => $userId, 'super_user' => TRUE]);
        $admin = $this->db->get();

        $this->db->select('creator_id') -> from('event_plan') -> where(['event_id' => $eventId, 'creator_id' => $userId]);
        $creator = $this->db->get();
        
        if (isset($creator->result()[0])) {
            return 'creator';
        } else if (!empty($admin->result())) {
            return 'admin';
        } else {
            return 'user';
        }
    }

    public function removeNeed($needId)
    {//Supprime un besoin
        $this->db->delete('event_needs', array('event_needs_id' => $needId));
    }

    public function claim($eventId, $userId)
    {//Demande une invitation à un event
        $data['user_id'] = $userId;
        $data['event_id'] = $eventId;
        $this->db->insert('event_participants', $data);
    }

    public function acceptClaim($eventId, $userId)
    {//Accepte une invitation à un event
        $fees['user_id'] = $userId;
        $fees['event_id'] = $eventId;
        $fees['fees'] = 0;
        $this->db->insert('membership_fees', $fees);

        $data['authorized'] = TRUE;
        $this->db->where(['user_id' => $userId, 'event_id' => $eventId]);
        $this->db->update('event_participants', $data);
    }

    public function deleteParticipant($eventId, $userId)
    {//Supprime un participant
        $this->db->delete('event_participants', array('event_id' => $eventId, 'user_id' => $userId));
        $this->db->delete('membership_fees', array('event_id' => $eventId, 'user_id' => $userId));

        $data['supplier_id'] = NULL;
        $this->db->where(['supplier_id' => $userId, 'event_id' => $eventId]);
        $this->db->update('event_needs', $data);
    }
}