<?php

class Admin_booking_model extends CI_Model {

	function get_data($id=""){
		
		$date=date("Y-m-d");
		
		$this->db->select("*");
		$this->db->from("booking a");
		$this->db->join("booking_detail z","z.booking_id=a.booking_id");
		$this->db->join("member b","b.member_id=a.member_id");
		$this->db->join("treatment_price c","c.treatment_price_id=z.treatment_price_id");
		$this->db->join("stylist_price d","d.stylist_price_id=z.stylist_price_id");
		$this->db->join("treatment e","e.treatment_id=c.treatment_id");
		$this->db->join("stylist f","f.stylist_id=d.stylist_id");

		if($this->session->userdata("user_group_id")>1){
			$this->db->where("a.branch_id",$this->session->userdata("branch_id"));
		}
		
		
		
		$this->db->where("a.deleted","0");
		
		$this->db->where("a.booking_date > ",$date);
		//$this->db->group_by("a.member_id,a.booking_date,e.treatment_id,f.stylist_id");
		$this->db->group_by("a.member_id,a.booking_date");
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	
	function get_history($branch_id="",$date_start="",$date_end=""){
		$date=date("Y-m-d");
		$sql="select * from booking as a
				LEFT JOIN member as b ON b.member_id=a.member_id
				LEFT JOIN booking_detail as z on z.booking_id=a.booking_id
				LEFT JOIN treatment_price as c ON c.treatment_price_id=z.treatment_price_id
				LEFT JOIN stylist_price as d ON d.stylist_price_id=z.stylist_price_id
				LEFT JOIN treatment as e ON e.treatment_id=c.treatment_id
				LEFT JOIN stylist as f ON f.stylist_id=d.stylist_id
				LEFT JOIN branch as g on g.branch_id=a.branch_id
				
				WHERE a.deleted='0'
					
			";
		if($date_start!=""&&$date_end!=""):
			$sql .=" AND a.booking_date BETWEEN '".$date_start."' AND '".$date_end."'";
			
		else:
			if($date_start!=""):
				$sql .=" AND a.booking_date='".$date_start."'";
			elseif($date_end!=""):
				$sql .=" AND a.booking_date='".$date_end."'";
			else:
				$sql .=" AND a.booking_date<'".$date."'";
			endif;
		endif;
		if($this->session->userdata("user_group_id")>1){
			$sql .=" AND a.branch_id='".$this->session->userdata("branch_id")."'";		
		}
		else{
			if($branch_id!=""):
			$sql .=" AND a.branch_id='".$branch_id."'";
			endif;
		}
		$sql .=" GROUP BY a.booking_id
				ORDER BY a.booking_date desc";
		//echo $sql;
		$query=$this->db->query($sql);
		
		return $query->result_array();
	}
	
}