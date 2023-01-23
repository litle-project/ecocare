<?php

class Api_city extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_master_list_model");

	}
	
	function index(){
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
		
		$city=$this->api_master_list_model->get_city($limit,$offset);
		
		foreach($city as $row){
			$json_city[] = $row["city_name"];
		}
		
		
		$api["CITY_LIST"] = $json_city;
		
		$data2=json_encode($api);
		
		echo $data2;
	}

}