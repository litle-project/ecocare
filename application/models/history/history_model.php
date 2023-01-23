<?php

class history_model extends CI_Model {

    function install($id='')
    {
        $this->db->select('*');
        $this->db->from('contract a');
        if (!empty($id)) {
            $this->db->where('contract_id', $id);
        }
        $this->db->join('customer_master b', 'b.customer_id = a.customer_id', 'left');
        $this->db->join('customer_address c', 'c.address_id = a.address_id', 'inner');
        $this->db->like('a.created_date', date('Y-m'));
        $this->db->where('a.deleted', '0');
        $this->db->where('a.contract_purpose', '1');
        $this->db->where('a.assign_status', '1');
        $this->db->where('a.install_date !=', date('Y-m-d'));
        $this->db->order_by('a.contract_id', 'desc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function service($id='')
    {
        $this->db->select('*');
        $this->db->from('contract a');
        if (!empty($id)) {
            $this->db->where('contract_id', $id);
        }
        $this->db->join('customer_master b', 'b.customer_id = a.customer_id', 'left');
        $this->db->join('customer_address c', 'c.address_id = a.address_id', 'inner');
        $this->db->like('a.created_date', date('Y-m'));
        $this->db->where('a.deleted', '0');
        $this->db->where('a.contract_purpose', '2');
        $this->db->where('a.assign_status', '1');
        $this->db->where('a.install_date !=', date('Y-m-d'));
        $this->db->order_by('a.contract_id', 'desc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function inventory($id='')
	{
        $this->db->select("*");
        $this->db->from("inventory_log a");
        $this->db->join("inventory b", "b.inventory_id = a.inventory_id");
        $this->db->join("product_master c", "c.product_id = b.product_id");
        $this->db->join("branch d", "d.branch_id = b.branch_id");
        $this->db->join("gudang e", "e.gudang_id = b.gudang_id");
        $query = $this->db->get();
        return $query->result_array();
	}
}
