<?php
  
class Profile extends CI_Controller 
{

    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->model('profile_model');
        $this->layout->add_css('style');
        $this->layout->add_js('jquery-3.4.1.min');
        $this->layout->add_js('toastr');
        $this->layout->add_js('front');
        $this->layout->add_js('main');
    }

    public function index() {
        if ($this->login_model->checkLogin() > 0) {
            $this->load->library('form_validation');
                
            // Validation rule
            $this->form_validation->set_rules('alias', 'Pseudonyme', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('city_address', 'Ville de l\'évènement', 'required');
            $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required');
            $this->form_validation->set_rules('address', 'Adresse', 'required');
            $this->form_validation->set_rules('birth_date', 'Date de naissance', 'required');
            $this->form_validation->set_rules('name', 'Nom', 'required');
            $this->form_validation->set_rules('first_name', 'Prénom', 'required');
            $this->form_validation->set_rules('sex', 'Sexe', 'required');

            if ($this->form_validation->run() == FALSE) { 
                $data['user'] = $this->profile_model->showProfile($this->session->userdata('id'));
                $this->layout->view('profile',$data);
            } else {
                $this->profile_model->editProfile($this->session->userdata('id'));
                $this->session->set_userdata('toast-success', 'Votre profil a bien été modifié');
                $data['user'] = $this->profile_model->showProfile($this->session->userdata('id'));
                $this->layout->view('profile',$data);
            }
        } else {
            redirect('/login');
        }
    }
}