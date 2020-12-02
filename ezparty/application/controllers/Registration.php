<?php
  
   class Registration extends CI_Controller {
   
    public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));
        $this->load->library('bcrypt');
        $this->layout->add_css('style');
        $this->layout->add_js('jquery-3.4.1.min');
        $this->layout->add_js('toastr');
        $this->layout->add_js('front');
        $this->layout->add_js('main');
        $this->layout->add_js('mdb.min');
         
    } 
	
    public function index() {			

        $this->load->library('form_validation');
                
        // Validation rule 
        $this->form_validation->set_rules('name', 'Nom', 'required');
        $this->form_validation->set_rules('first_name', 'Prénom', 'required');
        $this->form_validation->set_rules('alias', 'Nom de compte', 'required');
        $this->form_validation->set_rules('birth_date', 'Date de naissance', 'required');
        $this->form_validation->set_rules('sex', 'Sexe', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_customer');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[35]');
        $this->form_validation->set_rules('city_address', 'Ville', 'required');
        $this->form_validation->set_rules('zip_code_address', 'Code postal', 'required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('address', 'Adresse', 'required');	 
			
        if ($this->form_validation->run() == FALSE) { 
            $this->layout->view('registration');
        } 
        else { 
            $this->load->model('register_model');
		    $this->register_model->saveCustomer();
		    $this->session->set_userdata('toast-success', 'Vous êtes enregistré');
            redirect('/login');
        } 
    }

	public function check_customer($email)
	{
	    $query = $this->db->where('email', $email)->get("user");
        if ($query->num_rows() > 0)
        //Si un compte avec le même email existe
		{
            $this->session->set_userdata('toast-error', 'L\'email '.$email.' est déjà utilisé par un autre compte');
            return FALSE;
		} else 
			return TRUE;
	}	
   }