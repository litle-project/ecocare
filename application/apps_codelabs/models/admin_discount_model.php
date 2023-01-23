<?php

class Admin_discount_model extends CI_Model {

	function get_data(){
		$id = $this->session->userdata("branch_id");
		
		
		$this->db->where("deleted","0");
		$this->db->where("branch_id",$id);
		$query = $this->db->get("discount");
		
		
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$data["day"]=$row["day"];
				
				
				$treat = explode(",",$row["treatment_id"]);
				$price = explode(",",$row["discount_price"]);
				
				$this->db->select("*");
				$this->db->from("treatment a");
				$this->db->join("treatment_price b","b.treatment_id=a.treatment_id");
				$this->db->where("a.deleted","0");			
				$this->db->where_in("a.treatment_id",$treat);			
				$this->db->group_by("a.treatment_id");
				$query2 = $this->db->get();
				
				$data["treat"]=$query2->result_array();
				$data["disc"]=$price;
				$data["treats"]=$treat;
			
				$all[]=$data;
			}
			
			
		
		}else{
			$all = array();
		}
		
		return $all;
		
	}
	
	
	function get_day(){
		$day = array(
					"1" => "Senin",
					"2" => "Selasa",
					"3" => "Rabu",
					"4" => "Kamis",
					"5" => "Jum'at",
					"6" => "Sabtu",
					"7" => "Minggu",
					);
					
		return $day;			
	}
	
	function get_treatment_price(){
		$id = $this->session->userdata("branch_id");
		
		$this->db->select("*");
		$this->db->from("treatment a");
		$this->db->join("treatment_price b","b.treatment_id=a.treatment_id");
		$this->db->where("a.deleted","0");	
		$this->db->where("b.branch_id",$id);		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function cek_day($day){
		$this->db->where("deleted","0");
		$this->db->where("day",$day);
		$this->db->where("branch_id",$this->session->userdata("branch_id"));
		
		$query = $this->db->get("discount");
		
		return $query->num_rows();
	}
	
	function get_discount($day){
		$id = $this->session->userdata("branch_id");
		
		$this->db->where("deleted","0");
		$this->db->where("branch_id",$id);
		$this->db->where("day",$day);
		$query = $this->db->get("discount");
		$row = $query->row_array();
		
		if(count($row)>0){
		
			$treat = explode(",",$row["treatment_id"]);
			$price = explode(",",$row["discount_price"]);
			
			for($i=0; $i<count($treat); $i++){
				
				$all[$treat[$i]]=$price[$i];
				
			}
	
			return $all;
		}else{
			return array();
		}
	}

	
}