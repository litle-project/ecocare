<?php

class Return_barang_model extends CI_Model
{
	
	public function get_data($schedule_type)
	{
		$this->db->select("*");
		$this->db->from("contract_schedule a");
		$this->db->join("contract b", "b.contract_id = a.contract_id");
		$this->db->where_in("a.schedule_type", $schedule_type);
		$this->db->where("b.deleted", "0");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_complaint_product($id)
	{
		$this->db->select("*");
		$this->db->from("contract_schedule_detail a");
		$this->db->join("product_master b", "b.product_id = a.product_id");
		$this->db->join("product_category c", "c.category_id = b.category_id");
		$this->db->where("a.contract_schedule_id", $id);
		$this->db->where('a.product_type', '2');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_complaint_package($id)
	{
		$this->db->select("a.*, b.package_id, b.package_name");
		$this->db->from("contract_schedule_detail a");
		$this->db->join("product_package b", "b.package_id = a.package_id");
		$this->db->where("a.contract_schedule_id", $id);
		$this->db->where('a.product_type', '1');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_rts($id='')
	{
		$this->db->select("*");
		$this->db->from("log_return a");
		$this->db->join("contract b", "b.contract_id = a.contract_id");
		$this->db->join("customer_master c", "c.customer_id = b.customer_id");
		$this->db->join("product_master d", "d.product_id = a.product_id");
		$this->db->join("product_category e", "e.category_id = d.category_id");
		$this->db->where("a.contract_schedule_id", $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function data_package($package_id='')
	{

		$this->db->select('*');
		$this->db->from('product_package a');
		$this->db->join('product_package_detail b', 'b.package_id = a.package_id', 'left');
		$this->db->join('product_master c', 'c.product_id = b.product_id');
		$this->db->join('product_category d', 'd.category_id = c.category_id');
		$this->db->where('a.package_id', $package_id);
		$this->db->group_by('b.product_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}