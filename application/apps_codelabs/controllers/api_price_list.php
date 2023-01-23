<?php

class Api_price_list extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_price_list_model");

	}
	
	function index(){
	
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
		
		if(empty($limit)){
			$limit = "5";
		}
		
		if(empty($offset)){
			$offset = "0";
		}
	
		$branch_name=$this->input->get_post("BRANCH_NAME");
	
		$branch=$this->api_price_list_model->get_branch($branch_name);
		
		if(count($branch) > 0){
		
				$price_list=$this->api_price_list_model->get_data($branch["branch_id"],$limit,$offset);
				
				if(count($price_list) > 0){
					foreach($price_list as $price){
						$json["TREATMENT_NAME"] = $price["treatment_name"];
						$json["TREATMENT_DESC"] = $price["treatment_desc"];
						$json["TREATMENT_IMAGE"] = base_url()."media/treatment/".$price["treatment_image"];
						$json["TREATMENT_IMAGE_LOW"] = base_url()."media/treatment/low/".$price["treatment_image"];
						$json["TREATMENT_PRICE"] = $price["treatment_price"];
						
						$all[] = $json;
					}
				}else{
					$all=array();
				}
				
		}else{
			$all=array();
		}
		
		$api["PRICE_LIST"]=$all;
		
		$data=$api;
		
		echo json_encode($data);
	}

}