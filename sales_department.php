<?php

generate_csv(monthly_pay_dates(), $argv[1] ); 

function monthly_pay_dates(){
		
	$monthly_report = array();
	$month = 12;
	for ($i=1 ; $i<=12; $i++)
	{
		$monthName =date("F",mktime(0,0,0 , $i, 1));
		$first_day = date("D",mktime(0,0,0 , $i, 1, date("Y"))); 	
		$last_day = date("D",mktime(0,0,0 , $i+1, 0, date("Y"))); 	
		
		$bonus_payout_day = date("D",mktime(0,0,0 , $i,15, date("Y")));
		
		$pay_day =0;
		///pay days
		if(($last_day=="Sat")){
			// ameranise the dates
			// todays date
			$dateold= date("m/d/Y",mktime(0,0,0 , $i+1, 0, date("Y")));
			// - 1 day
			$yesterday  =  date('D  d/m/Y',strtotime($dateold."-1 days"));
			$pay_day = $yesterday;
		}
		else if($last_day=="Sun"){
			// ameranise the dates
			// todays date
			$dateold= date("m/d/Y",mktime(0,0,0 , $i+1, 0, date("Y")));
			// on sundy - 2 days
			$yesterday  =  date('D  d/m/Y',strtotime($dateold."-2 days"));
			$pay_day = $yesterday;
		}
		else{
			// pay money on week day
			$pay_day = date("D d/m/y",mktime(0,0,0 , $i+1, 0, date("Y")));
		}
		//bonuses
		if(($bonus_payout_day=="Sat") ||( $bonus_payout_day=="Sun" )){
			$number_days =(date("w",mktime(0,0,0 , $i,15, date("Y"))) - 2);
					if($number_days == -2){
						$number_days = 3;
					}
			 $dateold= date("m/d/Y",mktime(0,0,0 , $i, 15, date("Y")));
			$following_wednesday  =  date('D  d/m/Y',strtotime($dateold."+".$number_days." days"));
			$bonus_payout= "$following_wednesday";
			// $pay_day = $yesterday. "   mmmm ".$dateold;
		}

		else{

		$bonus_payout = date("w  D d/m/y",mktime(0,0,0 , $i,15, date("Y")));
		}
		
		$monthlyInfo["month_name"] = $monthName;
		$monthlyInfo["pay_day"] = $pay_day;
		$monthlyInfo["bonus_payout"] = $bonus_payout;

		array_push($monthly_report, $monthlyInfo);
	}
	return $monthly_report;
}

function generate_csv($report, $arg){
	$csv_file = fopen("$arg.csv", 'w');
		foreach($report as $flds){
			fputcsv($csv_file, $flds);
		}
		fclose($csv_file);
		echo "file created $arg.csv ";
}
		
  ?>