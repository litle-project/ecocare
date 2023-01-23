<?php

class Admin_product_model extends CI_Model {
	function get_data($id=""){
        $this->db->select("*, a.created_date as created_date");
        $this->db->join("category b","a.category_id =b.category_id","left");
        $this->db->where("a.deleted","0");
        if($id!=""){
                $this->db->where("a.product_id",$id);
        }
        $this->db->order_by("a.product_id","desc");
        $query=$this->db->get("product a");
        return $query->result_array();
    }
	
    function get_data_inv($id=""){
        $this->db->select("*, a.created_date as created_date");
        $this->db->join("category b","a.category_id =b.category_id","left");
        $this->db->join("inventory c","a.product_id =c.product_id");
        $this->db->where("a.deleted","0");
        if($id!=""){
                $this->db->where("a.product_id",$id);
        }
        $this->db->order_by("a.product_id","desc");
        $query=$this->db->get("product a");
        return $query->result_array();
    }
	
	function get_data_image($id=""){       
        $this->db->select("*");
        //$this->db->join("category b","a.category_id =b.category_id","left");
        $this->db->where("a.deleted","0");
        if($id!=""){
                $this->db->where("a.product_id",$id);
        }
        $this->db->order_by("a.product_image_id","desc");
        $query=$this->db->get("product_image a");
        return $query->result_array();
    }

    function package($id=""){       
        $this->db->select("*");
        //$this->db->join("category b","a.category_id =b.category_id","left");
        $this->db->where("a.deleted","0");
        if($id!=""){
                $this->db->where("a.package_id",$id);
        }
        $this->db->order_by("a.package_id","desc");
        $query=$this->db->get("package a");
        return $query->result_array();
     }
    
    
    function package_detail($package_id=""){
        $this->db->select("*");
        //$this->db->join("category b","a.category_id =b.category_id","left");
        $this->db->where("a.deleted","0");
        if($id!=""){
                $this->db->where("a.package_id",$id);
        }
        $this->db->order_by("a.package_detail_id","desc");
        $query=$this->db->get("package_detail a");
        return $query->result_array();
    }

    function get_category(){
        $this->db->where("deleted","0");
        
        
        $data[""]="Pilih...";
        $query=$this->db->get("restaurant_category");
        foreach($query->result() as $row){
            $data[$row->restaurant_category_id]=$row->restaurant_category_name;
        }
        
        return $data;
    }

    function holiday($id=""){
        $this->db->select("*");
        $this->db->select("date_format(a.holiday_from,'%d %M %Y') as holiday_from_date",false);
        $this->db->select("date_format(a.holiday_to,'%d %M %Y') as holiday_to_date",false);
        //$this->db->join("category b","a.category_id =b.category_id","left");
        $this->db->where("a.deleted","0");
        if($id!=""){
                $this->db->where("a.holiday_id",$id);
        }
        $this->db->order_by("a.holiday_id","desc");
        $query=$this->db->get("holiday a");
        return $query->result_array();
    }

    public function inventory($id="")
    {
        $this->db->select("*");
        $this->db->from("inventory a");
        if (!empty($id)) {
            $this->db->where("a.inventory_id", $id);
        }
        $this->db->join("product b", "b.product_id = a.product_id");
        $this->db->join("category c", "c.category_id = b.category_id");
        $this->db->join("branch d", "d.branch_id = a.branch_id");
        $this->db->join("gudang e", "e.gudang_id = a.gudang_id");
        $this->db->where("a.deleted","0");
        $this->db->where("b.deleted","0");
        $this->db->order_by("a.inventory_id","desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    function inventory_old($id=""){
        $this->db->select("*, a.created_date as created_date");
        $this->db->join("branch b","a.branch_id =b.branch_id","left");
        $this->db->join("gudang c","a.gudang_id =c.gudang_id","left");
        $this->db->join("product d","a.product_id =d.product_id","left");
        $this->db->join('category e', 'd.category_id = e.category_id', 'left');
        $this->db->where("a.deleted","0");
        $this->db->where("d.deleted","0");
        if($id!=""){
                $this->db->where("a.inventory_id",$id);
        }
        $this->db->order_by("a.inventory_id","desc");
        $query=$this->db->get("inventory a");
        return $query->result_array();
    }

    function insert($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function product_at_inventory() {
        $this->db->select("product_id");
        $this->db->from("inventory");
        $this->db->where("deleted","0");
        $query = $this->db->get()->result_array();
        return $query;
    }

    function product_by_package($package_id) {
        $this->db->select("a.package_id,a.package_detail_id,a.package_detail_total_per_service, a.package_detail_period, b.product_code,b.product_name,c.category_name,a.package_detail_qty");
        $this->db->from("package_detail a");
        $this->db->join("product b", "a.product_id=b.product_id");
        $this->db->join("category c", "b.category_id=c.category_id");
        $this->db->where("a.package_id",$package_id);
        $query = $this->db->get()->result_array();
        return $query;
    }

    function stock_at_warehouse($gudang_id){
        $this->db->select('*');
        $this->db->from('inventory a');
        $this->db->join('product b', 'a.product_id = b.product_id', 'left');
        $this->db->join('branch c', 'c.branch_id = a.branch_id', 'left');
        $this->db->join('gudang d', 'd.gudang_id = a.gudang_id', 'left');
        $this->db->join('category e', 'e.category_id = b.category_id', 'left');
        $this->db->where('a.gudang_id', $gudang_id);
        $this->db->where('a.deleted', "0");
        $this->db->order_by('a.gudang_id', 'asc');
        $this->db->group_by('a.product_id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function check_aroma_warehouse($gudang_id,$product_id){
        $this->db->select('*');
        $this->db->from('product_aroma_stock a');
        $this->db->join('gudang b', 'b.gudang_id = a.gudang_id', 'left');
        $this->db->join('product c', 'c.product_id = a.product_id', 'left');
        $this->db->join('product_aroma d', 'd.product_aroma_id = a.product_aroma_id', 'left');
        $this->db->where('a.deleted', '0');
        $this->db->where('a.gudang_id', $gudang_id);
        $this->db->where('a.product_id', $product_id);
        $this->db->order_by('d.product_aroma_name', 'desc');
        $query = $this->db->get()->result_array();
        return $query;
    }
}