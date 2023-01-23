<?php 
class Content_model extends CI_Model {
	
	function get_data($id="")
	{
		
		$this->db->select("*");
		$this->db->from("content a");
		$this->db->join("content_category b","b.content_category_id=a.content_category_id");
		$this->db->where("a.deleted","0");
		$this->db->where("a.content_location","0");
		
		if($id!=""){
			$this->db->where("a.content_id",$id);
		
		}
		
		$this->db->order_by("a.content_id","desc");
		$query=$this->db->get();

		
		return $query->result_array();
		
	}
	
	
	function get_site($id="")
	{
		
		$this->db->select("*");
		$this->db->from("content a");
		
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.content_id",$id);
		
		}
		
		$this->db->order_by("a.content_id","desc");
		$query=$this->db->get();

		
		return $query->result_array();
		
	}
	
	function cat(){
	
		$this->db->where("deleted","0");
		$query=$this->db->get("content_category");
		
		$data[""]="Please Select";
		
		foreach($query->result() as $row){
			$data[$row->content_category_id]=$row->content_category_name;
		}
		
		return $data;
	}
	
	
	
}
