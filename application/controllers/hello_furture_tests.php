<?php

class hello_furture_tests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'googlecal', 'workingdays', 'unit_test'));
        $this->load->model('icalendar');
    }
	public function index(){
		
		$test = 1+1;
		$expected = 2;
		$test_name = "first test";
		$this->unit->run($test, $expected, $test_name);
		
		$no_weeks = $this->workingdays->get_weeks(date('Y',strtotime($this->icalendar->unbooked_slots(1)[0]->start_date)),date('m',strtotime($this->icalendar->unbooked_slots(1)[0]->start_date)) );
	    $test_name4 = "Number weeks in month";
		$this->unit->run($no_weeks, 4, $test_name4);
		$this->unit->run($no_weeks, 5, $test_name4);
		$test_name5 = "number of working days";
		$working_days  =count( $this->workingdays->working_days_in_month("05/01/2014"));
		$this->unit->run($working_days, 22, $test_name5);
		$this->unit->run($working_days, 24, $test_name5);
		$number_working_hours_in_month ="number of working hours in july 2014";
		$this->unit->run(count( $this->workingdays->working_days_in_month("07/01/2014"))*8, 184, $number_working_hours_in_month);
		$this->unit->run(count( $this->workingdays->working_days_in_month("07/01/2014"))*8, 188, $number_working_hours_in_month);
		$number_of_booked = "Number of booked hours in July 2014";
		
		$this->unit->run( $this->icalendar->total_hours_worked("Normal")->numberHours, 150, $number_of_booked);
		$this->unit->run( $this->icalendar->total_hours_worked("Normal")->numberHours, 155, $number_of_booked);
		$number_of_unbooked ="Number of un-booked hours in July 2014";
		$exspected = (count( $this->workingdays->working_days_in_month("07/01/2014"))*8) -($this->icalendar->total_hours_worked("Normal")->numberHours);
		$this->unit->run( $exspected, 34, $number_of_unbooked);
		  
		  
		  //$template_rows = "\n\t".'<tr>';
		//$template_rows .= "\n\t\t".'<th >{item}</th>';
		//$template_rows .= "\n\t\t".'<td >{result}</td>';
		//$template_rows .= "\n\t".'</tr>';
		$str= " 	<div class='col-md-6'><table  class=\"table table-striped table-bordered table-hover\"> 
							{rows}
							
				
				
						</table></div>";//$this->load->view('template/test_page');
			 $this->unit->set_template($str);
	
			echo ' <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
	echo $this->unit->report();
		
		echo "it works  $working_days  ";
	}
}
?>