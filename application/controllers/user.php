<?php
class user extends CI_Controller
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
       // $this->register();
	   // set up initial view and show an enquiry form to end user	   
	   $this->load->view('user_registration_view');
    }
	
	/*
	Send email on successfull submittion of form
	*/
	 private function sendEmail($data)
    {
        $from_email = 'willliam.pritchard@williampritchard.co.uk'; //change this to yours
        $subject = 'Blubolt Enquiry';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config); 
         $this->email->from($from_email, 'Blubolt');
        $this->email->to("williamprritchard@googlemail.com");
		$this->email->subject($subject);
        $this->email->message($this->load->view('receipt',$data,true));
		
		$this->email->send();
        //send mail
        
		$this->email->clear();
		$this->email->initialize($config); 
		$this->email->from($from_email, 'Blubolt');
        $this->email->to($data["email"]);
		$this->email->bcc("enquiries@example.com");
        $this->email->subject($subject);
        $this->email->message($this->load->view('enquire',$data,true));
		
		
        return $this->email->send();
    }
/*
*  ajax call to submit enquiry information
*/
    function register()
    {
		$responce ="";
        //set validation rules
        $this->form_validation->set_rules('fname', 'Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[mailing_list.email]');
        $this->form_validation->set_rules('lname', 'Enquiry text', 'trim|required|min_length[3]|xss_clean|callback_alpha_numeric_spaces');
  
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            // fails
			$data["error"] = 1;
			$data["result"] =  $this->load->view('form_errors_view',"",true);
		  
        }
        else
        {
            //insert the user registration details into database
			$data["error"] = 0;
            $data["result"] = array(
                'name' => $this->input->post('fname'),
                'comment' => $this->input->post('lname'),
                'email' => $this->input->post('email')
            );
            
            // insert form data into database
             if ($this->user_model->insertUser($data["result"]))
            {
                // send email
               if ($this->sendEmail($data["result"]))
                {
                    // successfully sent mail
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!</div>');
                    
                }
                else
                {
                    // error
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                  
                 }
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('user/register');
            }
        }
		 
		echo json_encode($data);
    }
    
    function verify($hash=NULL)
    {
        if ($this->user_model->verifyEmailID($hash))
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('user/register');
        }
        else
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('user/register');
        }
    }
	/*
	   regular expression 
	*/
	function alpha_numeric_spaces($str){
		return (!preg_match("/^([-a-z0-9_£$%&@,.()@#!\r\n ])+$/i",$str)) ? false:true;
	}
}
?>