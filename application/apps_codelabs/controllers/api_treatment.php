<?php

class Api_treatment extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_master_list_model");

	}
	
	function index(){
	
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
	
		$branch_name=$this->input->get_post("BRANCH_NAME");
		$treatment=$this->api_master_list_model->get_treatment($branch_name,$limit,$offset);
		
		if(count($treatment) > 0){
			foreach($treatment as $row){
				$json_treatment[] = $row["treatment_name"];
			}
		}else{
			$json_treatment=array();
		}
		
		$api["TREATMENT_LIST"] = $json_treatment;
		
		$data2=json_encode($api);
		
		echo $data2;
	}

}