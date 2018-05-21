<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*   library to convert the ics data file into an array .
*    This will be used to store to data into the database
*/
class Workingdays 
{
  
	public function working_days_in_month($dateof_month){
		$format = strtotime($dateof_month);
		$workdays = array();
		$type = CAL_GREGORIAN;
		$month = date('n',$format); // Month ID, 1 through to 12.
		$year = date('Y',$format); // Year in 4 digit 2009 format.
        
		$day_count = cal_days_in_month($type, $month, $year); // Get the amount of days
       
		//loop through all days
		for ($i = 1; $i <= $day_count; $i++) {

				$date = $year.'/'.$month.'/'.$i; //format date
				$get_name = date('l', strtotime($date)); //get week day
				$day_name = substr($get_name, 0, 3); // Trim day name to 3 chars

				//if not a weekend add day to array
				if($day_name != 'Sun' && $day_name != 'Sat'){
					$workdays[] = $i;
				}

		}
		
		return $workdays;
	}
	
	public function get_weeks($year, $month){
		$days_in_month = date("t", mktime(0,0,$month,1,$year));
		$weeks_in_months =1;
		$weeks = array();
		for($day=1; $day<=$days_in_month; $day++){
			$week_day =date("w", mktime(0,0,0,$month,$day,$year));
			$weeks[$weeks_in_months][$week_day] = $day;
			if($week_day==6){
				$weeks_in_months++;
			}
		}
	    
		return count($weeks);
	}
		
      
}
?>