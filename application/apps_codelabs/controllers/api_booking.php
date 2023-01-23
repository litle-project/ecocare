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

		if($this->input->post()){
	
			$member_id = $this->input->post("MEMBER_ID");
			$branch_name = $this->input->post("BRANCH_NAME");
			
			$branch = $this->api_booking_model->get_branch($branch_name);
			$branch_id = $branch["branch_id"];
			
			$booking_date = $this->input->post("BOOKING_DATE");
			
			$now = date("Y-m-d");
			$newdate = date("Y-m-d",strtotime ( '+2 week' , strtotime ( $now ) ) ) ;
			
			if($booking_date >= $newdate){
				
				
				$booking_time = explode("<>",$this->input->post("BOOKING_TIME"));
				$treatment_name = explode("<>",$this->input->post("TREATMENT_NAME"));
				$stylist_name = explode("<>",$this->input->post("STYLIST_NAME"));
				
				$cek_member = $this->api_booking_model->cek_member_booking($member_id,$booking_date);
				
				if(count($cek_member) > 0){
				
					$id = $cek_member["booking_id"];
				}else{
					$data = array(
								"member_id" => $member_id,
								"branch_id" => $branch_id,
								"booking_date" => $booking_date,
								"booking_status" => "1",
								);
					$this->db->insert("booking",$data);
					$id=$this->db->insert_id();
				}
			
				for($i=0; $i<count($booking_time); $i++){
				

					$get_tprice = $this->api_booking_model->get_tprice($branch_id,$treatment_name[$i]);
					$get_sprice = $this->api_booking_model->get_sprice($get_tprice["treatment_id"],$stylist_name[$i]);
					$cek_treatment = $this->api_booking_model->cek_treatment($get_tprice["treatment_id"],$branch_id,$booking_date,$booking_time[$i]);
					$cek_stylist = $this->api_booking_model->cek_stylist($get_sprice["stylist_id"],$branch_id,$booking_date,$booking_time[$i]);
					
					if( ($cek_treatment==0 AND $cek_stylist == 0) OR ($cek_treatment==1 AND $cek_stylist == 0) ){
						
						$data2 = array(
									"booking_id" => $id,
									"booking_time" => $booking_time[$i],
									"treatment_price_id" => $get_tprice["treatment_price_id"],
									"treatment_price" => $get_tprice["treatment_price"],
									"stylist_price_id" => $get_sprice["stylist_price_id"],
									"stylist_price" => $get_sprice["stylist_price"],
									);
						$this->db->insert("booking_detail",$data2);
						$bok[] = "BOOKING $i SUCCESS";
						$cek[] = "0";
					}else{
						$bok[] = "BOOKING ".($i+1)." FAILED";
						//echo "tidak insert";
						$cek[] = "1";
					}
				
					$all[] = $bok;
					
				}
			
				$status = "SUCCESS";
				$var = "ALL BOOKING SUCCESS";
				for($x=0; $x< count($cek); $x++){
					
					if($cek[$x] == "1"){
						$var = $bok[$x];
						
						if(count($cek_member) < 1){
						$sql = "delete from booking where booking_id='".$id."'";
						$this->db->query($sql);
						$sql2 = "delete from booking_detail where booking_id='".$id."'";
						$this->db->query($sql2);
						}
						
					}
					
					
				}
			}else{
				$var = "BOOKING FAILED DATE OF BOOKING MINUMUM 2 WEEKS FROM NOW";
				$status = "FAILED";
			}
		}else{
			$var = "BOOKING FAILED PLEASE INPUT VALID DATA";
			$status = "FAILED";
		}
		
		
	
		$json["STATUS"] = $status;
		$json["MESSAGE"] = $var;
		$json["DATA"] = array();
		
		
		
		
		$api=json_encode($json);
		
		echo $api;
	}
	
	
	
	function cancel_sample(){
		if($this->input->post()){
			$book = $this->get_book();
			
			$data["book"]=$book;
		}
	
		$page="api/booking/view";
		$data["branch"]=$this->api_booking_model->set_dropdowm("branch","branch_name","branch_name");
		$this->load->view($page,$data);
	}
	
	function cancel_book(){
		$id = $this->input->get("BOOKING_DETAIL_ID");
		$data = array(
					"booking_detail_status" => "1"
					);
		$this->db->where("booking_detail_id",$id);
		$this->db->update("booking_detail",$data);
		
		
		$api["STATUS"]="SUCCESS";
		$api["MESSAGE"]="CANCEL BOOKING SUCCESS";
		$api["DATA"] = array();
		
		
		$json = json_encode($api);
		
		echo $json;
		//redirect("api_booking/cancel_sample");
	}
	
	function get_book(){
		$member_id =  $this->input->get_post("MEMBER_ID");
		$branch_name =  $this->input->get_post("BRANCH_NAME");
		$booking_date =  $this->input->get_post("BOOKING_DATE");
		
		$url = site_url("api_booking/json_booking?MEMBER_ID=".$member_id."&BRANCH_NAME=".rawurlencode($branch_name)."&BOOKING_DATE=".rawurlencode($booking_date)."");
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		return $obj->BOOKING;
		/*
		print_r("<pre>");
		print_r($obj->BOOKING);
		print_r("</pre>");
		*/
	
	}
	
	function json_booking(){
	
			$member_id =  $this->input->get_post("MEMBER_ID");
			$branch_name =  $this->input->get_post("BRANCH_NAME");
			$booking_date =  $this->input->get_post("BOOKING_DATE");
			
			$get_data = $this->api_booking_model->get_booking($member_id,$branch_name,$booking_date);
		
		if(count($get_data) > 0){		
			foreach($get_data as $row){
				$api["BOOKING_DETAIL_ID"] = $row["booking_detail_id"];
				$api["BOOKING_TIME"] = date("H:i",strtotime($row["booking_time"]));
				$api["BOOKING_TREATMENT_NAME"] = $row["treatment_name"];
				$api["BOOKING_TREATMENT_PRICE"] = $row["treatment_price"];
				$api["BOOKING_STYLIST_NAME"] = $row["stylist_name"];
				$api["BOOKING_STYLIST_PRICE"] = $row["stylist_price"];
				$api["BOOKING_TOTAL_PRICE"] = ($row["treatment_price"]+$row["stylist_price"]);
				
				
				if($row["booking_detail_status"]==0){
					$status = "pending";
				}else if($row["booking_detail_status"]==1){
					$status = "cancel";
				}else{
					$status = "approved";
				}
				
				$api["BOOKING_STATUS"] = $status;
				$api2[]=$api;
			}
			

			$json["BOOKING"] = $api2;
			
			
		}else{
			$json["BOOKING"] = array();
		}
		
		$all=json_encode($json);;
		echo $all;
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