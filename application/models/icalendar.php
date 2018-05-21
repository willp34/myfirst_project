<?php 

class icalendar extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert records into icalendar table 
    function insertIcal($data)
    {
        return $this->db->insert('icalendar', $data);
    }
	
	function showIcal_records(){
		$this->db->select("summary ,typeWork , sum(numberHours ) as numberHours ");
		$this->db->from("icalendar");
		$this->db->where('typeWork',"Normal");
		$this->db->group_by('summary,typeWork'); 
		$this->db->order_by("numberHours","desc");
		return $this->db->get()->result();
		
	}
	
	function getmonth_firstDate(){
		$this->db->select(" Date_format(start_date,'%m/%01/%Y') as first_date", false);
		$this->db->from("icalendar");
		$this->db->group_by('start_date'); 
		return $this->db->get()->row()->first_date;
	}
	
	function unbooked_slots($week_number){
		$this->db->select("* , (8-sum(numberHours)) as unbooked  , week(start_date) - week(Date_format(start_date,'%Y-%m-%01'))+1 as wkNo", false);
		//$this->db->select("Date_format(start_date,'%Y-%m-%01')  AS wkNo",false);
		$this->db->from("icalendar");
		$this->db->where("numberHours >",0);
		$this->db->where("week(start_date) - week(Date_format(start_date,'%Y-%m-%01'))+1 =",$week_number);
		$this->db->group_by('start_date'); 
		$this->db->order_by("start_date");
	
		return $this->db->get()->result();
		
	} 
	function  total_hours_worked($type){
		
		if($type=="Normal"){
			
			$this->db->select("sum(numberHours ) as numberHours ");
		}
		else{
			$this->db->select("sum(overtime ) as numberHours ");
		}
		
		$this->db->from("icalendar");
		//$this->db->where('typeWork',$type); 
		
		return $this->db->get()->row();
	}
	
	function remove_calendar_records(){
		
		$this->db->empty_table('icalendar');
	}
    
}
?>