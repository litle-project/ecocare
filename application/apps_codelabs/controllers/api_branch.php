<?php

class Api_branch extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_master_list_model");

	}
	
	function index(){
	
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
	
		$city_name=$this->input->get_post("CITY_NAME");
		$branch=$this->api_master_list_model->get_branch($city_name,$limit,$offset);
		
		foreach($branch as $row){
			$json_branch[] = $row["branch_name"];
		}
		
		$api["BRANCH_LIST"] = $json_branch;
		
		$data2=json_encode($api);
		
		echo $data2;
	}

}