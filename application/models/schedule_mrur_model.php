<?php
class Schedule_mrur_model extends CI_Model {

	public function get_data_today($date){
        $this->db->select('*');
        $this->db->from('contract_schedule a');
        $this->db->join('contract b', 'b.contract_id = a.contract_id');
        $this->db->where("schedule_date", $date);
        $query = $this->db->get()->result_array();
        return $query;
    }

    function get_data_next_week($date_start="",$date_end=""){
        $this->db->select('*');
        $this->db->from('contract_schedule a');
        $this->db->join('contract b', 'a.contract_id = b.contract_id', 'left');
        $this->db->where("a.schedule_date BETWEEN '" . $date_start . " 00:00:00' AND '" . $date_end . " 23:59:59'");
        $query = $this->db->get()->result_array();
        return $query;
    }
} 