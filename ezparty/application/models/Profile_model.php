<?php

class Profile_model extends CI_Model
{
    public function showProfile($id)
    {//Récupère les infos du profil de l'user
        $data = array();
        $this->db->select('*') -> from('user') -> where(['id_user' => $id]);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function editProfile($id)
    {//Edite le profil
        $data['alias'] = $this->input->post('alias');
        $data['email'] = $this->input->post('email');
        $data['city_address'] = $this->input->post('city_address');
        $data['zip_code_address'] = $this->input->post('zip_code_address');
        $data['address'] = $this->input->post('address');
        $data['birth_date'] = $this->input->post('birth_date');
        $data['name'] = $this->input->post('name');
        $data['first_name'] = $this->input->post('first_name');
        $data['sex'] = $this->input->post('sex');

        $this->db->where(['id_user' => $id]);
        $this->db->update('user', $data);
    }
}