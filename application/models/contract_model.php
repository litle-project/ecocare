<?php

class Contract_model extends CI_Model {
	
    public function get_data($id='')
    {
        $this->db->select("*");
        $this->db->from("contract a");
        if (!empty($id)) {
            $this->db->where("contract_id", $id);
        }
        $this->db->join("customer_master b", "b.customer_id = a.customer_id", 'left');
        $this->db->join("customer_address c", "c.address_id = a.address_id", 'left');
        $this->db->where("a.deleted", "0");
        $this->db->where("b.deleted", "0");
        $this->db->order_by("a.contract_id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function detail_product($id)
    {
        $this->db->select("*");
        $this->db->from("product_master a");
        $this->db->join("product_category b", "b.category_id = a.category_id");
        $this->db->where("a.deleted", "0");
        $product = $this->db->get()->result_array();
        
        foreach ($product as $key) {
            $this->db->select('*');
            $this->db->from('contract_detail');
            $this->db->where('contract_id', $id);
            $this->db->where("contract_type", "2"); // contract type 2 = product
            $this->db->where('product_id', $key['product_id']);
            $query = $this->db->get()->result_array();

            if (count($query) > 0) {
                $array['selected']    = "checked";

                if($query["price"] != "0") {
                    $array["price"] = $query["price"];
                }
                if($query["amount"] != "0") {
                    $array["amount"] = $query["amount"];
                }  
                $json[] = $array;
            }else{
                $json = $key;
            }
        }
        return $json;
    }

    function get_contract_product($id) {
        $this->db->select("*");
        $this->db->from("contract_detail a");
        $this->db->join("product_master b","a.product_id = b.product_id","left");
        $this->db->join("product_category d","b.category_id = d.category_id","left");
        $this->db->where("a.deleted", '0');
        $this->db->where("a.contract_id", $id);
        $this->db->where("a.contract_type", '2');
        // $this->db->order_by("contract_type","DESC");
        // $this->db->group_by("a.contract_detail_id");
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_contract_package($id) {
        $this->db->select("*");
        $this->db->from("contract_detail a");
        $this->db->join("product_package b","b.package_id = a.package_id");
        $this->db->where("a.deleted", '0');
        $this->db->where("a.contract_id",$id);
        $this->db->where("a.contract_type", '1');
        $this->db->order_by("a.contract_type","DESC");
        // $this->db->group_by("a.contract_detail_id");
        $query = $this->db->get()->result_array();
        return $query;
    }
}