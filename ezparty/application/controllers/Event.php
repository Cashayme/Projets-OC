<?php
  
class Event extends CI_Controller 
{
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->model('event_model');
        $this->layout->add_css('style');
        $this->layout->add_js('jquery-3.4.1.min');
        $this->layout->add_js('toastr');
        $this->layout->add_js('mdb.min');
        $this->layout->add_js('front');
        $this->layout->add_js('event');
        $this->layout->add_js('main');
    } 
    
    public function index() {
        $this->layout->add_js('ajax/listevent');
        $data['events'] = $this->event_model->listEvent(0);
        $this->layout->view('event_list', $data);
    }

    public function more($offset) {
        $data['events'] = $this->event_model->listEvent($offset);
        $this->load->view('more',$data);
    }

    public function create() {			
        if ($this->login_model->checkLogin() > 0) {
            $this->load->library('form_validation');
			
            // Validation rule 
           $this->form_validation->set_rules('event_name', 'Nom de l\'évènement', 'required');
           $this->form_validation->set_rules('event_description', 'Description', 'required');
           $this->form_validation->set_rules('city_address', 'Ville de l\'évènement', 'required');
           $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required');
           $this->form_validation->set_rules('address', 'Adresse', 'required');
           $this->form_validation->set_rules('event_date', 'Date de l\'évènement', 'required');
                   
               if ($this->form_validation->run() == FALSE) {
                   $this->layout->view('event_form'); 
               } else { 
                   $userId = $this->login_model->getInfos($this->session->userdata('email'), 'id_user');

                   // Config upload images
                   $config['encrypt_name'] = TRUE;
                   $config['upload_path']= './assets/images/uploaded_images';
                   $config['allowed_types']= 'gif|jpg|png';
                   $this->load->library('upload', $config);
                   $this->upload->do_upload('file_name');
                   $file_name = $this->upload->data();

                   $this->event_model->createEvent($userId, $file_name['file_name']);
                   $this->session->set_userdata('toast-success', 'Votre évènement a été créé');
                   redirect('/event/myevents');
               } 

        } else {
            redirect('/login');
        }
    }

    public function plan($id) {
        if ($this->login_model->checkLogin() > 0) {

            $this->layout->add_js('map');

            $data['event'] = html_escape($this->event_model->showEvent($id));

            if (!empty($data['event'][0])) {
                //si l'event existe
                if ($this->event_model->isParticipants($id, $this->session->userdata('id'), TRUE)) {
                    //Si l'user est participant affiche le plan de l'event
                    $data['needs'] = $this->event_model->getEventNeeds($id);
                    $data['participants'] = html_escape($this->event_model->participantsList($id));

                    $data['claimers'] = html_escape($this->event_model->claimersList($id));
                    $data['p_needs'] = html_escape($this->event_model->participantsNeeds($id));
                    $data['p_rank'] = $this->event_model->participantsRank($id)[0];
                    $data['total_fees'] = $this->event_model->totalFees($id);
    
                    if($this->event_model->isAdmin($id, $this->session->userdata('id')) == 'creator') {
                        $data['creator'] = '1';
                    }
    
                    if($this->event_model->isAdmin($id, $this->session->userdata('id')) == 'admin') {
                        $data['admin'] = '1';
                    }
                    
                   $this->layout->view('event_plan', $data);
    
                } else if ($this->event_model->isParticipants($id, $this->session->userdata('id'), FALSE)){
                    //Si l'user n'a pas encore été accepté à l'event affiche la vue d'invitation en attente 
    
                    $data['event'] = $this->event_model->showEvent($id);
                    $data['msg'] = 'Votre invitation n\'a pas encore été acceptée';
    
                    $this->layout->view('event_invit',$data);
    
                } else {
                    //Si l'user n'a pas demandé à faire partie des participants
                    $data['event'] = $this->event_model->showEvent($id);
    
                    $this->layout->view('event_invit',$data);
                }
            } else {
                $this->layout->view('error_404');
            }
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function fees($eventId) {
        if ($this->login_model->checkLogin() > 0) {
            $this->load->library('form_validation');
                
            /* Validation rule */
            $this->form_validation->set_rules('new_fees', 'Nouvelle cotisation', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                redirect('event/plan/'.$eventId.'');
            } else {
                $this->event_model->newFees($eventId, $this->session->userdata('id'));
                $this->session->set_userdata('toast-success', 'Nouvelle cotisation ajoutée');
                redirect('event/plan/'.$eventId.'#fees');
            } 
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function supplier($eventId, $needId) {
        if ($this->login_model->checkLogin() > 0) {
            $this->event_model->newSupplier($needId,$this->session->userdata('id'));
            redirect('event/plan/'.$eventId.'#participants');
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function myEvents() {
        if ($this->login_model->checkLogin() > 0) {
            $data['events'] = $this->event_model->myEvents($this->session->userdata('id'));
            $data['mine'] = 1;
            $this->layout->view('my_events',$data);
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function iParticipate() {
        if ($this->login_model->checkLogin() > 0) {
            $data['events'] = $this->event_model->iParticipate($this->session->userdata('id'));
            $this->layout->view('my_events',$data);
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function delete($eventId, $image) {
        if ($this->login_model->checkLogin() > 0) {
            if($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') {
                $this->event_model->deleteEvent($eventId, $this->session->userdata('id'));
                $this->session->set_userdata('toast-info', 'L\'évènement a été supprimé');

                if($image != 'default.jpg' ) {
                    unlink("assets/images/uploaded_images/$image");
                }
            }

            redirect('event/myevents');
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function edit($eventId)
    {
        if ($this->login_model->checkLogin() > 0) {
            if($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') {
                $this->load->library('form_validation');
                
                    /* Validation rule */
                $this->form_validation->set_rules('event_name', 'Nom de l\'évènement', 'required');
                $this->form_validation->set_rules('event_description', 'Description', 'required');
                $this->form_validation->set_rules('city_address', 'Ville de l\'évènement', 'required');
                $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required');
                $this->form_validation->set_rules('address', 'Adresse', 'required');
                $this->form_validation->set_rules('event_date', 'Date de l\'évènement', 'required');
            
                    
                if ($this->form_validation->run() == FALSE) {
                    $data['infos'] = $this->event_model->showEvent($eventId);
                    $data['needs'] = $this->event_model->getEventNeeds($eventId);
                    $this->layout->view('event_form', $data);

                } else { 
                    $userId = $this->session->userdata('id');

                    // Config upload images
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path']= './assets/images/uploaded_images';
                    $config['allowed_types']= 'gif|jpg|png';
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('file_name');
                    $file_name = $this->upload->data();

                    $this->event_model->editEvent($eventId, $userId, $file_name['file_name']);
                    $this->session->set_userdata('toast-success', 'L\'évenement a été modifié');
                    redirect('/event/myevents');
                }
            } else {
                redirect('/event/myevents');
            }

        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function removeSupplier($eventId, $needId) {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->removeSupplier($needId);
                redirect('event/plan/'.$eventId.'#needs');
            } else {
                redirect('event/plan/'.$eventId.'#needs');
            }

        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function rank($eventId, $userId, $state) {
        if ($this->login_model->checkLogin() > 0) {

            if($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') {

                if($state == 'up') {
                    $this->event_model->rank($eventId, $userId, TRUE);  
                } else {
                    $this->event_model->rank($eventId, $userId, FALSE);
                }
                
                redirect('event/plan/'.$eventId.'#participants');
            } else {
                redirect('event/plan/'.$eventId.'#participants');
            }

        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function removeNeed($eventId, $needId) {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->removeNeed($needId);
                redirect('event/plan/'.$eventId.'#needs');
            } else {
                redirect('event/plan/'.$eventId.'#needs');
            }
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function claim($eventId, $userId)
    {
        if ($this->login_model->checkLogin() > 0) {
            $this->event_model->claim($eventId, $userId);
            redirect('event/plan/'.$eventId.'');
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function acceptClaim($eventId, $userId)
    {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->acceptClaim($eventId, $userId);
                $this->session->set_userdata('toast-info', 'L\'utilisateur a rejoint les participants');
                redirect('event/plan/'.$eventId.'');
            } else {
                redirect('event/plan/'.$eventId.'');
            }
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }

    public function deleteParticipant($eventId, $userId)
    {
        if ($this->login_model->checkLogin() > 0) {
            if(($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'creator') || ($this->event_model->isAdmin($eventId, $this->session->userdata('id')) == 'admin')) {
                $this->event_model->deleteParticipant($eventId, $userId);
                $this->session->set_userdata('toast-info', 'L\'utilisateur ne fait plus partie des participants');
                redirect('event/plan/'.$eventId.'');
            } else {
                redirect('event/plan/'.$eventId.'');
            }
        } else {
            $this->session->set_userdata('toast-error', 'Vous devez être connecté pour faire ça');
            redirect('/login');
        }
    }
}