<?php

class Api_branch_list extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_branch_list_model");

	}
	
	function index(){
			
			
			$limit = $this->input->get_post("LIMIT");
			$offset = $this->input->get_post("OFFSET");
			$city_name = $this->input->get_post("CITY_NAME");
			
			
			$branch_list=$this->api_branch_list_model->get_data($city_name,$limit,$offset);
			
			foreach($branch_list as $branch){
				$json["BRANCH_NAME"] = $branch["branch_name"];
				$json["CITY_NAME"] = $branch["city_name"];
				$json["BRANCH_ADDRESS"] = $branch["branch_address"];
				$json["BRANCH_PHONE"] = $branch["branch_phone"];
				$json["BRANCH_LONG"] = $branch["branch_long"];
				$json["BRANCH_LAT"] = $branch["branch_lat"];
				$json["BRANCH_IMAGE"] = base_url()."media/branch/".$branch["branch_image"];
				$json["BRANCH_IMAGE_LOW"] = base_url()."media/branch/low/".$branch["branch_image"];
				
				$all[] = $json;
			}
		
		$api["BRANCH_LIST"]=$all;
		
		$data=$api;
		
		$data2=json_encode($data);
		
		/*
		$my_file = './api/branch_list.json';
		
		
		$handle = fopen($my_file, 'w') or die('Cannot create file:  '.$my_file);
		if(fwrite($handle, $data2)){
			echo "berhasil";
			echo "<script>alert('API updated'); history.back();</script>";
		}else{
			echo "gagal";
		}
		*/
		echo $data2;
	}

}