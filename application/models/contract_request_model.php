<?php

class Contract_request_model extends CI_Model {
	
    function get_data($id="") {
          $this->db->select("*");
          $this->db->from("contract_schedule a");
          if (!empty($id)) {
            $this->db->where("a.contract_schedule_id", $id);
          }
          $this->db->join("contract_schedule_detail b", "b.contract_schedule_id = a.contract_schedule_id");
          $this->db->join("contract c", "c.contract_id = a.contract_id");
          $this->db->where("a.deleted", "0");
          $this->db->where("a.schedule_type", "5");
          $this->db->group_by("a.contract_schedule_id");
          $query = $this->db->get()->result_array();
          return $query;
    }

    function get_product($id="") {
          $this->db->select("*");
          $this->db->from("contract a");
          if (!empty($id)) {
            $this->db->where("a.contract_id", $id);
          }
          $this->db->join("contract_detail b", "b.contract_id = a.contract_id");
          $this->db->join("product_master c", "c.product_id = b.product_id");
          $this->db->join("product_category d", "d.category_id = c.category_id");
          $this->db->where("c.deleted", "0");
          $this->db->where("a.terminate", "0");
          $this->db->group_by("b.product_id");
          $query = $this->db->get()->result_array();
          return $query;
    }

    function get_package($id="") {
          $this->db->select("*");
          $this->db->from("contract a");
          if (!empty($id)) {
            $this->db->where("a.contract_id", $id);
          }
          $this->db->join("contract_detail b", "b.contract_id = a.contract_id");
          $this->db->join("product_package c", "c.package_id = b.package_id");
          $this->db->where("c.deleted", "0");
          $this->db->where("a.terminate", "0");
          $query = $this->db->get()->result_array();
          return $query;
    }


    function get_product_detail($id='')
    {
          $this->db->select("*");
          $this->db->from("contract_schedule a");
          if (!empty($id)) {
            $this->db->where("a.contract_schedule_id", $id);
          }
          $this->db->join("contract b", "b.contract_id = a.contract_id");
          $this->db->join("contract_schedule_detail c", "c.contract_schedule_id = a.contract_schedule_id");
          $this->db->join("product_master d", "d.product_id = c.product_id");
          $this->db->join("product_category e", "e.category_id = d.category_id");
          $this->db->where("a.deleted", "0");
          $query = $this->db->get()->result_array();
          return $query;
    }

    function get_package_detail($id='')
    {
          $this->db->select("a.*, b.*, c.*, d.package_name, d.package_id");
          $this->db->from("contract_schedule a");
          if (!empty($id)) {
            $this->db->where("a.contract_schedule_id", $id);
          }
          $this->db->join("contract b", "b.contract_id = a.contract_id");
          $this->db->join("contract_schedule_detail c", "c.contract_schedule_id = a.contract_schedule_id");
          $this->db->join("product_package d", "d.package_id = c.package_id");
          $this->db->where("a.deleted", "0");
          $query = $this->db->get()->result_array();
          return $query;
    }
}