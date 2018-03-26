<?php
class user_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into user table
    function insertUser($data)
    {
        return $this->db->insert('mailing_list', $data);
    }
    
    //send verification email to user's email id
    function sendEmail($to_email)
    {
        $from_email = 'willliam.pritchard@williampritchard.co.uk'; //change this to yours
        $subject = 'Blubolt Enquiry';
        $message = ' Thank you for your request ,<br /><br /> your details should be listed below Thanks<br />Blubolt  Team';
        $message_blu =$this->load->view('template\receipt');// "This is receipt email";
        //configure email settings
        /* $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.williampritchard.co.uk'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'burton83'; //$from_email password*/
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config); 
         $this->email->from($from_email, 'Blubolt');
        $this->email->to("williamprritchard@googlemail.com");
		//$this->email->bcc("enquiries@example.com");
        $this->email->subject($subject);
        $this->email->message($message_blu);
		
		$this->email->send();
        //send mail
        
		$this->email->clear();
		$this->email->initialize($config); 
		$this->email->from($from_email, 'Blubolt');
        $this->email->to($to_email);
		$this->email->bcc("enquiries@example.com");
        $this->email->subject($subject);
        $this->email->message($message);
		
		
        return $this->email->send();
    }
    
    //activate user account
    function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('user', $data);
    }
}
?>