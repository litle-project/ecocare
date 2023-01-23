<?php

class Inventory_model extends CI_Model
{
	
	public function get_data($id='')
	{
        $this->db->select("*");
        $this->db->from("inventory a");
        if (!empty($id)) {
            $this->db->where("a.inventory_id", $id);
        }
        $this->db->join("product_master b", "b.product_id = a.product_id");
        $this->db->join("product_category c", "c.category_id = b.category_id");
        $this->db->join("branch d", "d.branch_id = a.branch_id");
        $this->db->join("gudang e", "e.gudang_id = a.gudang_id");
        $this->db->where("a.deleted","0");
        $this->db->where("b.deleted","0");
        $this->db->where("d.deleted","0");
        $this->db->where("e.deleted","0");
        $this->db->order_by("a.inventory_id","desc");
        $query = $this->db->get();
        return $query->result_array();
	}

	public function get_data_detail($inventory_id, $branch_id, $gudang_id, $product_id)
	{
        $this->db->select("*");
        $this->db->from("inventory_stock a");
        $this->db->join("product_aroma b", "b.product_aroma_id = a.product_aroma_id");
        $this->db->join("product_master c", "c.product_id = a.product_id");
        $this->db->where("a.inventory_id", $inventory_id);
        $this->db->where("a.branch_id", $branch_id);
        $this->db->where("a.gudang_id", $gudang_id);
        $this->db->where("a.product_id", $product_id);
        $this->db->where("a.deleted", "0");
        $query = $this->db->get();
        return $query->result_array();
	}

	// public function get_data_stock($id)
	// {
	// 	$this->db->
	// }
}