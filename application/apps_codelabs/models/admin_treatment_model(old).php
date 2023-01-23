<?php

class Admin_treatment_model extends CI_Model {

	function get_data($id=""){
		
		$this->db->select("*");
		$this->db->from("treatment a");
		$this->db->join("treatment_category b","b.treatment_category_id=a.treatment_category_id","left");
		
		
		if($id!=""){
			$this->db->where("a.treatment_id",$id);	
		}
		
		$this->db->where("a.deleted","0");
		$this->db->order_by("a.treatment_id","desc");
		$query = $this->db->get();
		
		
		return $query->result_array();
	}
	
	function get_price($id=""){
		
		$this->db->select("*");
		$this->db->from("treatment_price as a");
		$this->db->join("treatment as b","b.treatment_id=a.treatment_id","left");
		$this->db->join("branch as c","c.branch_id=a.branch_id","left");
		
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.treatment_id",$id);
		}
		
		
		if($this->session->userdata("user_group_id")>1){
			$this->db->where("a.branch_id",$this->session->userdata("branch_id"));
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}
	
	
	function price($id=""){
		
		$this->db->select("*");
		$this->db->from("treatment as a");
		$this->db->join("treatment_price as b","b.treatment_id=a.treatment_id","left");
		$this->db->join("branch as c","c.branch_id=b.branch_id","left");
		
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.treatment_id",$id);
		}
		
		
		if($this->session->userdata("user_group_id")>1){
			//$this->db->where("b.branch_id",$this->session->userdata("branch_id"));
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
			$sql2="select * from treatment_price as a
				left join branch as b on a.branch_id=b.branch_id
				where  a.treatment_id='".$row["treatment_id"]."' AND a.branch_id='".$this->session->userdata("branch_id")."'";
			$query2=$this->db->query($sql2);
			$row["menu"]=$query2->result_array();
			$all[]=$row;
		}
		
		return $all;
		
		//return $query->result_array();
	}
	
}