<?php

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        
        $this->var['output'] = '';

        $this->layout->add_css('style');
        $this->layout->add_js('jquery-3.4.1.min');
        $this->layout->add_js('toastr');
        $this->layout->add_js('front');
        $this->layout->add_js('main');
        
    }
    
    public function view($name, $data = array())
    {
        $this->output .= $this->CI->load->view($name, $data, true);
        
        $this->CI->load->view('../themes/default', array('output' => $this->output));
    }

    public function index()
    {
        $this->layout->view('home');
    }

    public function informations()
    {
        $this->layout->view('informations');
    }
}