<?php

class Api_master_list extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_master_list_model");

	}
	
	function index(){
	
		$city=$this->api_master_list_model->get_city();
		$branch=$this->api_master_list_model->get_branch();
		$stylist=$this->api_master_list_model->get_stylist();
		
		foreach($city as $row){
			$json_city[] = $row["city_name"];
		}
		
		foreach($branch as $row){
			$json_branch[] = $row["branch_name"];
		}
		
		foreach($stylist as $row){
			$json_stylist[] = $row["stylist_name"];
		}
		
		$api["CITY_LIST"] = $json_city;
		$api["BRANCH_LIST"] = $json_branch;
		$api["STYLIST_LIST"] = $json_stylist;
		
		
		$all=$api;
	
	
		
		$data["MASTER_LIST"]=$all;
				
		//print_r("<pre>");
		//print_r($data);
		//print_r("</pre>");
		//return $data;
		
		//print("\n");
		$data2=json_encode($data);
		
		$my_file = './api/master_list.json';
		
		
		$handle = fopen($my_file, 'w') or die('Cannot create file:  '.$my_file);
		if(fwrite($handle, $data2)){
			echo "berhasil";
			echo "<script>alert('API updated'); history.back();</script>";
		}else{
			echo "gagal";
		}
	}

}