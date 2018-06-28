<?php
class questions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('user_model');
    }
    
    function index()
    {
		echo "Questions";
       // $this->register();
	  $this->load->view('questions_layout');
    }
	
}