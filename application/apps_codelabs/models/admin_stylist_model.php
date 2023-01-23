<?php

class Admin_stylist_model extends CI_Model {

	function get_data($id=""){
		
		$this->db->select("*");
		$this->db->from("stylist as a");
		$this->db->join("branch as b","b.branch_id=a.branch_id","left");
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.stylist_id",$id);
		}
		
		
		if($this->session->userdata("user_group_id")>1){
			$this->db->where("a.branch_id",$this->session->userdata("branch_id"));
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}
	
	
	function get_price($id=""){
		
		$this->db->select("*");
		$this->db->from("stylist as a");
		$this->db->join("branch as b","b.branch_id=a.branch_id","left");
		$this->db->join("stylist_price as c","c.stylist_id=a.stylist_id","left");
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.stylist_id",$id);
		}
		
		
		if($this->session->userdata("user_group_id")>1){
			$this->db->where("a.branch_id",$this->session->userdata("branch_id"));
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function menu($id="")
	{
		$qq="";
		if($id!=""){
			$qq=" AND treatment_id='".$id."'";
		}
		$sql="select * from treatment WHERE deleted='0' $qq";
		$query=$this->db->query($sql);
		
		foreach($query->result_array() as $row){
			//$sql2="select * from treatment_price where  treatment_id='".$row["treatment_id"]."' AND branch_id='".$this->session->userdata("branch_id")."'";
			$sql2="select * from stylist_price as a
				left join stylist as b on a.stylist_id=b.stylist_id
				left join stylist_level as c on a.level_id=c.level_id
				where  a.treatment_id='".$row["treatment_id"]."' AND a.stylist_id='1'";
			$query2=$this->db->query($sql2);
			$row["menu"]=$query2->result_array();
			$all[]=$row;
		}
		
		return $all;
		
		//return $query->result_array();
	}

	
}