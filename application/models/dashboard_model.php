<?php

class Dashboard_model extends CI_Model {

	function best_selling_poduct() {
		$this->db->select("b.product_name,sum(a.amount) as total");
		$this->db->from("contract_detail a");
		$this->db->join("product_master b","a.product_id = b.product_id");
		$this->db->group_by("a.product_id");
		$this->db->order_by("total","DESC");
		$this->db->limit(10);
		$query=$this->db->get()->result_array();
		return $query;
	}
	
}