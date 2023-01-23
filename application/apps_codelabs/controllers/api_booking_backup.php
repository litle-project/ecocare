<?php

class Api_booking extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_booking_model");

	}
	
	function add_sample(){
	
		$page="api/booking/add";
		$data["branch"]=$this->api_booking_model->set_dropdowm("branch","branch_name","branch_name");
		$this->load->view($page,$data);
		
		
	}
	function add(){
		print_r("<pre>");
		print_r($this->input->post());
		print_r("</pre>");
		
		
	
		$member_id = $this->input->post("MEMBER_ID");
		$branch_name = $this->input->post("BRANCH_NAME");
		
		$branch = $this->api_booking_model->get_branch($branch_name);
		$branch_id = $branch["branch_id"];
		
		$booking_date = $this->input->post("BOOKING_DATE");
		$booking_time = $this->input->post("BOOKING_TIME");
		$treatment_name = $this->input->post("TREATMENT_NAME");
		$stylist_name = $this->input->post("STYLIST_NAME");
		
		
		

		$get_tprice = $this->api_booking_model->get_tprice($branch_id,$treatment_name);
		$get_sprice = $this->api_booking_model->get_sprice($get_tprice["treatment_id"],$stylist_name);
		$cek_treatment = $this->api_booking_model->cek_treatment($get_tprice["treatment_id"],$branch_id,$booking_date,$booking_time);
		$cek_stylist = $this->api_booking_model->cek_stylist($get_sprice["stylist_id"],$branch_id,$booking_date,$booking_time);
		
		
		//$cek_book = $this->api_booking_model->cek_book($branch_id,$get_tprice["treatment_id"],$get_sprice["stylist_id"],$booking_date);
		
		print_r("<pre>");
		print_r($cek_treatment);
		print_r("</pre>");
		print_r("<pre>");
		print_r($cek_stylist);
		print_r("</pre>");
		
		//echo $cek_book[$booking_time];
		if( ($cek_treatment==0 AND $cek_stylist == 0) OR ($cek_treatment==1 AND $cek_stylist == 0) ){
		
		$data = array(
					"member_id" => $member_id,
					"branch_id" => $branch_id,
					"booking_date" => $booking_date,
					"booking_status" => "0",
					);
		$this->db->insert("booking",$data);
		$id=$this->db->insert_id();
		
		$data2 = array(
					"booking_id" => $id,
					"booking_time" => $booking_time,
					"treatment_price_id" => $get_tprice["treatment_price_id"],
					"treatment_price" => $get_tprice["treatment_price"],
					"stylist_price_id" => $get_sprice["stylist_price_id"],
					"stylist_price" => $get_sprice["stylist_price"],
					);
		$this->db->insert("booking_detail",$data2);
		echo "insert";
		}else{
			echo "tidak insert";
		}
		
		
		
		
		
		
		/*
		$data2=json_encode($api);
		
		echo $data2;
		*/
	}
	
	function get(){
		
		$url = site_url("api_treatment");
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		print_r("<pre>");
		print_r($obj);
		print_r("</pre>");
	}
	
	function get_treatment(){
		
		$post = $this->input->post();
	
		$url = site_url("api_treatment?BRANCH_NAME=".rawurlencode($post["branch"])."");
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		
	
		//echo "<select>";
		echo "<option value=''>Please Select2</option>";
		foreach($obj->TREATMENT_LIST as $key=>$value){
			echo "<option>".$value."</option>";
		}
		//echo "</select>";
	}
	
	function get_tpric(){
		$post = $this->input->post();
		$tpirc = $this->api_booking_model->get_tpric($post["treat"]);
		
		if(count($tpirc) > 0){
			echo $tpirc["treatment_price"];
		}
	}
	
	function get_spric(){
		$post = $this->input->post();
		$tpirc = $this->api_booking_model->get_spric($post["stylist"]);
		
		if(count($tpirc) > 0)
			echo $tpirc["stylist_price"];
		
	}
	
	function get_stylist(){
		$post = $this->input->post();
	
		$url = site_url("api_booking/stylist_json?BRANCH_NAME=".rawurlencode($post["branch"])."&TREATMENT_NAME=".rawurlencode($post["treat"])."");
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		
	
		//echo "<select>";
		echo "<option value=''>Please Select2</option>";
		foreach($obj->STYLIST_LIST as $key=>$value){
			echo "<option>".$value."</option>";
		}
	}
	
	function stylist_json(){
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
	
		$branch_name=$this->input->get_post("BRANCH_NAME");
		$treatment_name=$this->input->get_post("TREATMENT_NAME");
		$stylist=$this->api_booking_model->get_stylist($branch_name,$treatment_name,$limit,$offset);
		
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