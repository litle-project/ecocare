<?php 
Class Calendar_model extends CI_Model {
	function get_data($id="") {
		$this->db->select("calendar_id,calendar_year,calendar_month,working_day,calendar_date");
		$this->db->from("calendar");
		$this->db->where("deleted","0");
		$this->db->order_by('calendar_date', 'desc');
		if($id!="") {
			$this->db->where("calendar_id",$id);
		}
		$query = $this->db->get()->result_array();
		return $query;
	}

	function check_if_calendar_not_exist($year,$month){
		$this->db->where("calendar_year",$year);
		$this->db->where("calendar_month",$month);
		$query = $this->db->get("calendar")->num_rows();
		if($query > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}