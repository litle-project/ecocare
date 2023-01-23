<?php

class Admin_city_model extends CI_Model {

	function get_data($id=""){
		
		if($id!=""){
			$this->db->where("city_id",$id);	
		}
		
		$this->db->where("deleted","0");
		$query = $this->db->get("city");
		
		return $query->result_array();
	}

	
}