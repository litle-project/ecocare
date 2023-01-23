<?php

class Api_discount_list extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_discount_list_model");

	}
	
	function index(){
	
			
			$day = array(
					"1" => "Senin",
					"2" => "Selasa",
					"3" => "Rabu",
					"4" => "Kamis",
					"5" => "Jum'at",
					"6" => "Sabtu",
					"7" => "Minggu",
					);
			
			
			$name = $this->input->get_post("BRANCH_NAME");
			$discount_list=$this->api_discount_list_model->get_data($name);
			
			if(count($discount_list) > 0){
				for($i=0; $i<count($discount_list); $i++){
					$json1["DAY"] = $day[$discount_list[$i]["day"]];
					for($x=0; $x<count($discount_list[$i]["treat"]); $x++){
						$json2["TREATMENT_NAME"] = $discount_list[$i]["treat"][$x]["treatment_name"];
						$json2["TREATMENT_DESC"] = $discount_list[$i]["treat"][$x]["treatment_desc"];
						$json2["TREATMENT_IMAGE"] = base_url()."media/treatment/".$discount_list[$i]["treat"][$x]["treatment_image"];
						$json2["TREATMENT_IMAGE_LOW"] = base_url()."media/treatment/low/".$discount_list[$i]["treat"][$x]["treatment_image"];
						$json2["TREATMENT_PRICE"] = $discount_list[$i]["treat"][$x]["treatment_price"];
						$json2["TREATMENT_DISC"] = $discount_list[$i]["disc"][$x];
						
						$ext[]=$json2;
					$x++;
					}
					$json1["TREATMENT_LIST"]=$ext;
					
					$all[] = $json1;
				}
			}else{
				$all=(object) array();
			}
		
		$api["DISCOUNT_LIST"]=$all;
		
		$data=$api;
		
		$data2=json_encode($data);
		/*
		$my_file = './api/discount_list.json';
		
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
		
		
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