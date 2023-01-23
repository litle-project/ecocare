<?php

class Api_stylist_list extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_stylist_list_model");

	}
	
	function index(){
	
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
	
		$branch_name=$this->input->get_post("BRANCH_NAME");
		$stylist=$this->api_stylist_list_model->get_data($branch_name,$limit,$offset);
		
		if(count($stylist) > 0){
			foreach($stylist as $row){
				$json["STYLIST_NAME"] = $row["stylist_name"];
				$json["STYLIST_PHONE"] = $row["stylist_phone"];
				$json["STYLIST_DESC"] = $row["stylist_desc"];
				$json["STYLIST_IMAGE"] = base_url()."media/stylist/".$row["stylist_photo"];
				$json["STYLIST_IMAGE_LOW"] = base_url()."media/stylist/low/".$row["stylist_photo"];
				$all[]=$json;
			}
		}else{
			$all=(object) array();
		}
		
		$data["STYLIST_LIST"] = $all;
		
		$data2=json_encode($data);
		
		echo $data2;
	}

}