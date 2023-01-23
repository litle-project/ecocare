<?php

class Admin_member_model extends CI_Model {

	function get_data($id=""){
		
		if($id !=""){
			$this->db->where("member_id",$id);			
		}
		
		$this->db->where("deleted","0");
		$query = $this->db->get("member");
		
		return $query->result_array();
	}

	
}