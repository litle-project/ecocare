<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_treatment extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_treatment_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Treatment";
		$data["page"]="treatment/view";
		$data["get_data"]=$this->admin_treatment_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$config['upload_path'] = "./media/treatment/";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$file="treatment_image";
			
			if ( ! $this->upload->do_upload($file)){
				$image="img_album_default.jpg";
			}else{
				$name=$this->upload->data($file);
				$image=$name['file_name'];
				
				$this->image_resize($image);
				
			}
			
			
			$input = array(
						"treatment_code" => $post["treatment_code"],
						"treatment_category_id" => $post["treatment_category_id"],
						"treatment_name" => $post["treatment_name"],
						"treatment_desc" => $post["treatment_desc"],
						"treatment_image" => $image,
						"treatment_duration" => $post["treatment_duration"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id"),
						);
			
			$this->db->insert("treatment",$input);
			
			$action="Add Treatment Name " . $post["treatment_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_treatment");
		endif;
		
		$data["title"]="Add Treatment";
		$data["page"]="treatment/add";
		
		
		$data["treatment_category"]= $this->dropdown->set("treatment_category","treatment_category_id","treatment_category_name");
		
		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			if($post["photo_status"]=="1"){
				$config['upload_path'] = "./media/treatment/";
				$config['allowed_types'] = "gif|jpg|png|jpeg";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				$file="treatment_image";
				
				if ( ! $this->upload->do_upload($file)){
					$image="img_album_default.jpg";
				}else{
					$name=$this->upload->data($file);
					$image=$name['file_name'];
					
					$this->image_resize($image);
					
					
					$input = array(
						"treatment_image" => $image
						);
			
					$this->db->where("treatment_id",$id);
					$this->db->update("treatment",$input);
				}
			}
			
			
			$input = array(
						"treatment_code" => $post["treatment_code"],
						"treatment_category_id" => $post["treatment_category_id"],
						"treatment_name" => $post["treatment_name"],
						"treatment_desc" => $post["treatment_desc"],
						"treatment_duration" => $post["treatment_duration"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("treatment_id",$id);
			$this->db->update("treatment",$input);
			
			$action="Edit Treatment name " . $post["treatment_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_treatment");
		endif;
		
		$data["title"]="Edit Treatment";
		$data["page"]="treatment/edit";
		$data["get_data"]=$this->admin_treatment_model->get_data($id);
		$data["treatment_category"]= $this->dropdown->set("treatment_category","treatment_category_id","treatment_category_name");
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("treatment_id",$id);
			$this->db->update("treatment",$data);
			
			$action="Delete Treatment ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_treatment");
	
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/treatment/'.$image.'';
			$config2['new_image'] = './media/treatment/low/'.$image.'';
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
