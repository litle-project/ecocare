<?php

class Ambil_barang_model extends CI_Model
{
	
	public function get_data_view()
	{
		$this->db->select('a.*, b.contract_id, b.contract_no, b.branch_id, c.branch_name');
		$this->db->from("contract_history a");
		$this->db->join("contract as b", "b.contract_id = a.contract_id");
		$this->db->join("branch as c", "c.branch_id = b.branch_id");
		$this->db->where("b.deleted", "0");
		$this->db->order_by("a.contract_history_id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data($contract_id='', $contract_history_id='')
	{
		$this->db->select("*");
		$this->db->from("contract a");
		$this->db->join("contract_history b", "b.contract_id = a.contract_id");
		$this->db->join("contract_schedule c", "c.contract_schedule_id = b.contract_schedule_id");
		$this->db->join("contract_teknisi d", "d.contract_id = c.contract_id");
		$this->db->where("a.contract_id", $contract_id);
		$this->db->where("b.contract_history_id", $contract_history_id);
		$this->db->where("a.deleted", "0");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_product($history_id)
	{
		$this->db->select("*");
		$this->db->from("contract_history_product a");
		$this->db->join("product_master b", "b.product_id = a.product_id");
		$this->db->join("product_category c", "c.category_id = b.category_id");
		// $this->db->join("contract_history_aroma d", "d.contract_history_id = a.contract_history_id", "left");
		$this->db->where("a.contract_history_id", $history_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_product_detail($history_id)
	{
		$this->db->select("*");
		$this->db->from("contract_history_product a");
		$this->db->join("product_master b", "b.product_id = a.product_id");
		$this->db->join("product_category c", "c.category_id = b.category_id");
		$this->db->join("contract_history_aroma d", "d.contract_history_id = a.contract_history_id", "left");
		$this->db->where("a.contract_history_id", $history_id);
		$this->db->group_by('a.product_id');
		$query = $this->db->get();
		return $query->result_array();
	}

}