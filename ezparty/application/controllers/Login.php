<?php
  
   class Login extends CI_Controller {
   
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
		if($this->session->userdata('logged')) {
			$this->session->set_userdata('toast-success', 'Vous déjà connecté');
			redirect('index');
		}
			
		// Validation rule
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');	 
			
        if ($this->form_validation->run() == FALSE) { 
            $this->layout->view('login'); 
        } else { 
			$this->load->model('login_model');
			$this->load->model('admin_model');
			$result = $this->login_model->login($this->input->post('email'));
			if ($result > 0) 
				{
				$this->session->set_userdata('logged', '1');
				$this->session->set_userdata('email', $this->login_model->getInfos($this->input->post('email'), email));
				$this->session->set_userdata('password', $this->login_model->getInfos($this->input->post('email'), password));
				$this->session->set_userdata('alias', $this->login_model->getInfos($this->input->post('email'), alias));
				$this->session->set_userdata('id', $this->login_model->getInfos($this->input->post('email'), id_user));

				if($this->admin_model->checkPowers($this->session->userdata('id'))) {
					$this->session->set_userdata('admin', 1);
				}

				$this->session->set_userdata('toast-success', 'Vous êtes connecté');
				redirect('index');
				} else { 
				$this->session->set_userdata('toast-error', 'L\'email et le mot de passe ne correspondent pas ou sont invalides');
				$this->layout->view('login');
				} 
		}
	} 

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login/index');
	}
 }
 
?>