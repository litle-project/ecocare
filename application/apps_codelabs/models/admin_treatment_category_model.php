<?php

class Admin_treatment_category_model extends CI_Model {

	function get_data($id=""){
		
		if($id!=""){
			$this->db->where("treatment_category_id",$id);	
		}
		
		$this->db->where("deleted","0");
		$query = $this->db->get("treatment_category");
		
		return $query->result_array();
	}
	
}