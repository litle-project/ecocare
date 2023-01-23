<?php

class Contract_lost_model extends CI_Model
{
	
	public function get_data($id='')
	{
		$this->db->select('*');
		$this->db->from('log_termination a');
		$this->db->join('contract b', 'b.contract_id = a.contract_id');
		$this->db->join('customer_master c', 'c.customer_id = b.customer_id');
		$this->db->join('customer_address d', 'd.address_id = b.address_id');
		$this->db->where('a.deleted', '0');
		$this->db->order_by('a.termination_id', 'desc');
		$this->db->group_by('a.contract_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_detail($id)
	{
		$this->db->select('*');
		$this->db->from('log_termination a');
		$this->db->where('a.contract_id', $id);
		$this->db->join('contract b', 'b.contract_id = a.contract_id');
		$this->db->join('customer_master c', 'c.customer_id = b.customer_id');
		$this->db->join('customer_address d', 'd.address_id = b.address_id');
		$this->db->join('contract_schedule e', 'e.contract_schedule_id = a.contract_schedule_id');
		$this->db->where('a.deleted', '0');
		$this->db->order_by('a.termination_id', 'desc');
		$this->db->group_by('a.contract_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_product($id='')
	{
		$this->db->select('*');
		$this->db->from('log_termination a');
		$this->db->join('product_master b', 'b.product_id = a.product_id');
		$this->db->join('product_category c', 'c.category_id = b.category_id');
		$this->db->join('contract d', 'd.contract_id = a.contract_id');
		$this->db->where('a.contract_id', $id);
		$this->db->where('a.deleted', '0');
		$this->db->where('d.deleted', '0');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_teknisi($id='')
	{
		$this->db->select('*');
		$this->db->from('log_termination a');
		$this->db->join('contract_schedule b', 'b.contract_schedule_id = a.contract_schedule_id');
		$this->db->join('contract_teknisi c', 'c.contract_schedule_id = b.contract_schedule_id');
		$this->db->join('teknisi_master d', 'd.teknisi_id = c.teknisi_id');
		$this->db->join('contract e', 'e.contract_id = a.contract_id');
		$this->db->where('a.contract_id', $id);
		$this->db->where('a.deleted', '0');
		$this->db->where('e.deleted', '0');
		$this->db->where('b.schedule_type', '3');
		$this->db->group_by('a.contract_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}