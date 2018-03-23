<?php 
$config['contact_rules'] =  array(
           'name' => array(
                     'field' => 'name',
                     'label' => 'First Name',
                     'rules' => 'trim|required|xss_clean'
                     ),
           'sname' => array(
                     'field' => 'fname',
                     'label' => 'Second Name',
                     'rules' => 'trim|required|xss_clean'
                     ),
           'age' => array(
                     'field' => 'age',
                     'label' => 'Age',
                     'rules' => 'trim|required|xss_clean'
                     ),
           'message' => array(
                      'field' => 'message',
                      'label' => 'Message',
                      'rules' => 'trim|required|xss_clean'
                      )
           );
		   
		   ?>