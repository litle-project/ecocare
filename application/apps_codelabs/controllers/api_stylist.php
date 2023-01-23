<?php

class Api_stylist extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_master_list_model");

	}
	
	function index(){
	
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
	
		$branch_name=$this->input->get_post("BRANCH_NAME");
		$stylist=$this->api_master_list_model->get_stylist($branch_name,$limit,$offset);
		
		if(count($stylist) > 0){
			foreach($stylist as $row){
				$json_stylist[] = $row["stylist_name"];
			}
		}else{
			$json_stylist=array();
		}
		
		$api["STYLIST_LIST"] = $json_stylist;
		
		$data2=json_encode($api);
		
		echo $data2;
	}

}