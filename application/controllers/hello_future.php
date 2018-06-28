<?php

class hello_future extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'googlecal', 'workingdays'));
        $this->load->database();
        $this->load->model('icalendar');
    }
    
    function index()
    {
		/* $to_time = strtotime("2008-12-13 10:42:00");
			$from_time = strtotime("2008-12-13 10:21:00");
			echo round(abs($to_time - $from_time) / 60,2). " minute"; */
	//	$this->IcalImport();
	if(!empty($this->icalendar->showIcal_records("Normal")))
	{
	    $no_weeks = $this->workingdays->get_weeks(date('Y',strtotime($this->icalendar->unbooked_slots(1)[0]->start_date)),date('m',strtotime($this->icalendar->unbooked_slots(1)[0]->start_date)) );
		$format= strtotime(  $this->icalendar->getmonth_firstDate());
		$monthly_statistics= array();
		$working_days["description"] = "Number of working hours ".date('M Y',$format);
		$working_days["total"] = count( $this->workingdays->working_days_in_month( $this->icalendar->getmonth_firstDate()))*8;
		$hours_booked["description"] = "Number of hours booked ".date('M Y',$format);
		$hours_booked["total"] = $this->icalendar->total_hours_worked("Normal")->numberHours;
		$hours_unbooked["description"] = "Number of hours unbooked ".date('M Y',$format);
		$hours_unbooked["total"] = (count( $this->workingdays->working_days_in_month( $this->icalendar->getmonth_firstDate()))*8) -($this->icalendar->total_hours_worked("Normal")->numberHours);
		$overtime["description"] = "over time  ".date('M Y',$format);
		$overtime["total"] = $this->icalendar->total_hours_worked("Overtime")->numberHours;
		
		array_push($monthly_statistics,$working_days);
		array_push($monthly_statistics,$hours_booked);
		array_push($monthly_statistics,$hours_unbooked);
		array_push($monthly_statistics,$overtime);
		//print_r($monthly_statistics);
		$week_free_periods = array();
		for( $i =1; $i<=$no_weeks; $i++){
			$weekly_info["tab_ref"] = "week_$i";
			$weekly_info["tab_label"] ="week $i"; 
			if($i ==1){
				$weekly_info["tab_menu_class"] ="active";
				$weekly_info["tab_div_class"] = "in active";
			}
			else{
					$weekly_info["tab_menu_class"] ="";
					$weekly_info["tab_div_class"] = "";
			}
			$weekly_info["weekly_results"] =$this->icalendar->unbooked_slots($i) ;
			array_push($week_free_periods,$weekly_info);
			
		}
				//print_r($this->icalendar->unbooked_slots(5));
		//echo date('m',strtotime($this->icalendar->unbooked_slots(1)[0]->start_date))."   YEAR ".date('Y',strtotime($this->icalendar->unbooked_slots(1)[0]->start_date));
		
		$icalendarInfo = array( "ical_records"=> $this->icalendar->showIcal_records(),
								"monthly_stats" => $monthly_statistics,
								"time_period" => date('M Y',$format),
								"show_unbooked_slots"=> $week_free_periods  //$this->icalendar->unbooked_slots(2)
		);
		
		 $this->load->view('hello_future_view', $icalendarInfo);
	}
		 else 
			  $this->load->view('add_calendar');
    }
	public function import(){
		$this->load->view('add_calendar');
	}
	public function add_calendar(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		
			$this->icalendar->remove_calendar_records();
			$this->IcalImport();
		echo "it works ";
	}
	
	private function IcalImport(){
			//echo "hi  ";
        $googleArr = $this->googlecal->load(file_get_contents( 'basic.ics' ));
	   //$this->load->view('user_registration_view');
		foreach($googleArr["VEVENT"] as $calItem ){
		
			// get description
			$summary = $calItem["SUMMARY"];
			// get start and end date and times
			$startDate = $this->getFormatforDate( $calItem["DTSTART"]);
			$startTime =intval($this->getFormatforTime( $calItem["DTSTART"]));
			
			
			$endDate = $this->getFormatforDate($calItem["DTEND"]);
			$endTime =intval($this->getFormatforTime( $calItem["DTEND"]));
			// time spent on projects
			$lengthOfwork = $endTime - $startTime; 
			$typeofWork = ($endTime >17.5) ? "Overtime" : "Normal";
			$over_time =($startTime <9) ? 9-$startTime : 0;
			$hoursWorked = ($lengthOfwork ==8) ? 7.5 : $lengthOfwork;
			if($startTime <9){
				
				$over_time = 9-$startTime;
				if(($endTime - $startTime) == $over_time){
					$hoursWorked = ($endTime - $startTime) - $over_time;
				}
				else
					$hoursWorked = ($endTime - $startTime) - $over_time ;
			}
			else if($endTime >17.5){
			  $over_time = ($endTime - $startTime);
			  $hoursWorked = 0;
			}
			else{
				$hoursWorked = ($endTime - $startTime);
				$over_time =0;
			}
				$Ical_record = array(
						"summary" => $calItem["SUMMARY"],
						"start_date" =>  $this->getFormatforDate( $calItem["DTSTART"]),
						"end_date" => $this->getFormatforDate($calItem["DTEND"]),
						"numberHours" => $hoursWorked,
						"typeWork" => $typeofWork,
						"overtime" => $over_time
						);
			$this->icalendar->insertIcal($Ical_record);			
			/* echo "<p>$summary</p>";
			echo "<p>Start : $startDate   $startTime</p>";
			echo "<p> $endDate  $endTime</p>";
			echo "<p>Lenth of task : $hoursWorked  $typeofWork</p>";
			echo "<p>Overtime  $over_time</p>"; */
		}
		echo "imported successfully";
	}
	/**
	*  Takes in Param @data_string and returns date in dd/mm/yyyy format
	*/
	private function getFormatforDate($date_string){
		$end_dttimearr = explode('T', $date_string);		
		$date_end = date_create($end_dttimearr[0])->format('Y/m/d');		
		return $date_end;
	}
	
	
	/**
	*  Takes in Param @data_string and returns date in HH:mm format
	*/
	private function getFormatforTime($date_string){
		$end_dttimearr = explode('T', $date_string);
		$date_end = date_create($end_dttimearr[1])->format('H:i');
		return $date_end;
	}
}

?>