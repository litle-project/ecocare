<?php

class Api_member extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model("api_member_model");

	}
	
	function get_member($id,$msg){
	
		$row=$this->api_member_model->get_data($id);
		
		$api["MEMBER_ID"]=$row["member_id"];
		$api["MEMBER_USERNAME"]=$row["member_username"];
		$api["MEMBER_NAME"]=$row["member_name"];
		$api["MEMBER_NO"]=$row["member_no"];
		$api["MEMBER_DOB"]=date("d/m/Y",strtotime($row["member_dob"]));
		$api["MEMBER_GENDER"]=$row["member_gender"];
		$api["MEMBER_ADDRESS"]=$row["member_address"];
		$api["MEMBER_PHOTO"]=base_url()."media/member/".$row["member_photo"];
		$api["MEMBER_PHOTO_LOW"]=base_url()."media/member/low/".$row["member_photo"];
		$api["MEMBER_EMAIL"]=$row["member_email"];
		$all=$api;
	
	
		
		$data["STATUS"]="SUCCESS";
		$data["MESSAGE"]=$msg;
		$data["DATA"]=$all;
				
		//print_r("<pre>");
		//print_r($data);
		//print_r("</pre>");
		return $data;
		
	}
	
	function add_sample(){
		$page="api/member/add";
		$this->load->view($page);
	}
	
	function add(){
		
		if($this->input->post()){
			$post=$this->input->post();
			
			$user=$post["MEMBER_USERNAME"];
			$pass=$post["MEMBER_PASSWORD"];
			$member_no=$post["MEMBER_NO"];
			
			$imei=$post["IMEI"];
			$device=$post["DEVICE"];
			
			
			$sqlz="select * from member_login where member_no='".$member_no."' AND deleted='0'";
			$queryz=$this->db->query($sqlz);
			$numz=$queryz->num_rows();
			
			if($numz < 1){	
			
				$sql="select * from member_login where member_username='".$user."' AND deleted='0'";
				$query=$this->db->query($sql);
				$num=$query->num_rows();
				
				if($num < 1){
				
					$sql2="select * from member where member_no='".$member_no."' AND deleted='0'";
					//echo $sql2;
					$query2=$this->db->query($sql2);
					$num2=$query2->num_rows();
				
					if($num2 > 0){
						$config['upload_path'] = "./media/member/";
						$config['allowed_types'] = "gif|jpg|png|jpeg";
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						
						$file="MEMBER_PHOTO";
						
						if ( ! $this->upload->do_upload($file)){
							$image="img_album_default.jpg";
						}else{
							$name=$this->upload->data($file);
							$image=$name['file_name'];
							
							$this->image_resize($image);
							
						}
						
						
						
						$input=array(
										"member_username" => $user, 
										"member_password" => md5($pass),
										"member_no" => $member_no,
										"created_date" => date("Y-m-d H:i:s"),
										"imei" => $imei,
										"device" => $device,
										"actived" =>  "1"
									);
									
						$this->db->insert("member_login",$input);
						
						$data = $this->get_member($member_no,"REGISTER SUCCESS");
						
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="PLEASE INPUT VALID MEMBER NUMBER";
						$data["DATA"]=(object) array();	
					}
			
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="USERNAME ALREADY REGISTERED";
					$data["DATA"]=(object) array();	
				}
			
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="YOUR MEMBER NUMBER ALREADY REGISTERED";
				$data["DATA"]=(object) array();	
			}
			
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();	
		}
		
		echo json_encode($data);
	}
	
	function edit_sample(){
		$id=$this->input->get_post("MEMBER_NO");
		$page="api/member/edit";
		//echo $id;
		$data["get_data"]=$this->api_member_model->get_data($id);
		$this->load->view($page,$data);
		
	}
	
	function edit(){
		if($this->input->post()){
			$post=$this->input->post();
			
			$user=$post["MEMBER_USERNAME"];
			$pass1=$post["MEMBER_PASSWORD"];
			$pass2=$post["MEMBER_PASSWORD_NEW"];
			$member_no=$post["MEMBER_NO"];
			
			$sql = " select * from member_login where member_username = '".$user."' AND member_password='".md5($pass1)."' ";
			$que = $this->db->query($sql);
			$num = $que->num_rows();
			
			if($num > 0){
				
				
				
				
				if(!empty($pass2)){
					$input=array(
									"member_password" => md5($pass2),
									"updated_date" => date("Y-m-d H:i:s")
								);
					$this->db->where("member_no",$member_no);
					$this->db->update("member_login",$input);
				}
				
				
			
				$data = $this->get_member($member_no,"EDIT SUCCESS");
			
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="PASSWORD NOT VALID";
				$data["DATA"]=(object) array();	
			}
			
			
			
			
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT DATA";
			$data["DATA"]=(object) array();	
		}
		
		echo json_encode($data);
	}
	
	function login_sample(){
		$page="api/member/login";
		$this->load->view($page);
	}
	
	
	function login(){
		

		if($this->input->post()){
			$user = $this->input->post("MEMBER_USERNAME");
			$pass1 = $this->input->post("MEMBER_PASSWORD");
			
			$sql = " select * from member_login where member_username = '".$user."' AND member_password='".md5($pass1)."' ";
			$que = $this->db->query($sql);
			$num = $que->num_rows();
			
			if($num > 0){
				$sql2 = " select * from member_login where member_username = '".$user."' AND member_password='".md5($pass1)."' AND deleted='0'";
				$que2 = $this->db->query($sql2);
				$num2 = $que2->num_rows();
				
				if($num2 > 0){
					$sql3 = " select * from member_login where member_username = '".$user."' AND member_password='".md5($pass1)."' AND deleted='0' AND actived='1'";
					$que3 = $this->db->query($sql3);
					$num3 = $que3->num_rows();
					$row = $que3->row_array();
					if($num3 > 0){
						//redirect("api_member?MEMBER_ID=".$row["member_id"]."");
						$data = $this->get_member($row["member_no"],"LOGIN SUCCESS");
						
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="USER ACCOUNT NOT ACTIVED PLEASE CONTACT OUR SUPPORT";
						$data["DATA"]=(object) array();	
					}
					
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="USER ACCOUNT HAS BEEN DELETED PLEASE CONTACT OUR SUPPORT";
					$data["DATA"]=(object) array();	
				}
				
			
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="USERNAME OR PASSWORD IS WRONG";
				$data["DATA"]=(object) array();	
			}
			
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();	
		}
		
		echo json_encode($data);
		
		
		
	}
	
	function reset_password(){
	
		if($this->input->post()){
			$req=$this->input->get_post();
			
			$email=$req["EMAIL"];
			
			
			
			
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();	
		}
		
		echo json_encode($data);
		
		
		
	}

}