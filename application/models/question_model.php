<?php
class question_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
  // add survey
  function insert_survey($data)
    {
        return $this->db->insert('survey', $data);
    }
	
	 // add result
  function insert_survey_results($data)
    {
        return $this->db->insert('survey_results', $data);
    }
    //activate user account
    function show_Questions($question_id=null)
    {
    	$this->db->select("*");
		$this->db->from("questions parent");
		//$this->db->join('questions child', 'parent.idquestion = child.parent_question', 'right outer');
		$this->db->where('parent_question',$question_id);
		
		return $this->db->get()->result();
		
	} 
}
?>