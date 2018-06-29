<?php
class questions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url', 'string'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('question_model');
    }
    
    function index()
    {
		$survey_qs =$this->question_model->show_Questions();
		foreach( $survey_qs as $row){
			
			$row->question_options = $this->question_model->show_Questions($row->idquestion);
			$d[] = $row;
		}
		$data["Questions"] = $d;
		
       
	  $this->load->view('questions_layout',$data);
    }
	
	
	function process(){
		$survey_key ='svy_'.random_string('alnum',6);
		//echo "process  ".$this->input->post('comment'). '   '. $this->input->post('number_questions').'  '. $survey_key    ;
		$survey_data = array(
					'comment_msg' =>$this->input->post('comment'),
					'survey_token' =>$survey_key
				);
		$this->question_model->insert_survey($survey_data);
		
		for($i=1; $i<=$this->input->post('number_questions'); $i++){
			$survey_values = explode("-",$this->input->post("question_$i"));
		
			$survey_results_data = array(
					'token' =>$survey_key,
					'question_id' =>$survey_values[1],
					'result' =>$survey_values[0],
				);
			$this->question_model->insert_survey_results($survey_results_data);
			
				
		}
		$jsondata["result"] = '<div class="alert alert-success text-center">Thanks for doing the survey</div>';

		echo json_encode($jsondata);
		
	}
	
}