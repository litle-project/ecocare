<?php

class Admin_branch_model extends CI_Model {

	function get_data($id=""){
		
		$this->db->select("*");
		$this->db->from("branch a");
		$this->db->join("city b","b.city_id=a.city_id");
		
		if($id!=""){
			$this->db->where("a.branch_id",$id);	
		}
		
		$this->db->where("a.deleted","0");
		$query = $this->db->get();
		
		return $query->result_array();
	}

	
}