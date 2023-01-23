<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_member extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_member_model");
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Member";
		$data["page"]="member/view";
		$data["get_data"]=$this->admin_member_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post();

			$config['upload_path'] = "./media/member/";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$file="member_photo";
			
			if ( ! $this->upload->do_upload($file)){
				$image="img_album_default.jpg";
			}else{
				$name=$this->upload->data($file);
				$image=$name['file_name'];
				
				$this->image_resize($image);
				
			}
			
			
			$input = array(
						"member_no" => $post["member_no"],
						"member_name" => $post["member_name"],
						"member_dob" => $post["member_dob"],
						"member_gender" => $post["member_gender"],
						"member_email" => $post["member_email"],
						"member_photo" => $image,
						"member_address" => $post["member_address"],
						"member_telp" => $post["member_telp"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->insert("member",$input);
			
			$action="Add member Name " . $post["member_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_member");
		endif;
		
		$data["title"]="Add Member";
		$data["page"]="member/add";

		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 

			if($post["photo_status"]=="1"){
				$config['upload_path'] = "./media/member/";
				$config['allowed_types'] = "gif|jpg|png|jpeg";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				$file="member_photo";
				
				if ( ! $this->upload->do_upload($file)){
					$image="img_album_default.jpg";
				}else{
					$name=$this->upload->data($file);
					$image=$name['file_name'];
					
					$this->image_resize($image);
					
					
					$input = array(
						"member_photo" => $image
						);
			
					$this->db->where("member_id",$id);
					$this->db->update("member",$input);
				}
			}
			
			$input = array(
						"member_no" => $post["member_no"],
						"member_name" => $post["member_name"],
						"member_dob" => $post["member_dob"],
						"member_gender" => $post["member_gender"],
						"member_email" => $post["member_email"],
						"member_address" => $post["member_address"],
						"member_telp" => $post["member_telp"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("member_id",$id);
			$this->db->update("member",$input);
			
			$action="Update member ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_member");
		endif;
		
		$data["title"]="Edit member";
		$data["page"]="member/edit";
		$data["get_data"]=$this->admin_member_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("member_id",$id);
			$this->db->update("member",$data);
			
			$action="Delete member ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_member");
	
	}
	
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/member/'.$image.'';
			$config2['new_image'] = './media/member/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 400;
			$config2['height'] = 400;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}

}
