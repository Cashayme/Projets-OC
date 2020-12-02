<?php

class Register_model extends CI_Model
{
    public function saveCustomer()
    {//Enregistre un nouvel user
       $data['name'] = $this->input->post('name');
       $data['first_name'] = $this->input->post('first_name');
       $data['alias'] = $this->input->post('alias');
       $data['birth_date'] = $this->input->post('birth_date');
       $data['sex'] = $this->input->post('sex');
       $data['city_address'] = $this->input->post('city_address');
       $data['zip_code_address'] = $this->input->post('zip_code_address');
       $data['address'] = $this->input->post('address');
	   $data['email'] = $this->input->post('email');
	   $data['password'] = $this->bcrypt->hash_password($this->input->post('password'));
	   $this->db->insert('user', $data);
    }
}