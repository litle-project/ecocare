<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_branch extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_branch_model");
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Branch";
		$data["page"]="branch/view";
		$data["get_data"]=$this->admin_branch_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post();

			$config['upload_path'] = "./media/branch/";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$file="branch_image";
			
			if ( ! $this->upload->do_upload($file)){
				$image="img_album_default.jpg";
			}else{
				$name=$this->upload->data($file);
				$image=$name['file_name'];
				
				$this->image_resize($image);
				
			}
			
			
			$input = array(
						"branch_name" => $post["branch_name"],
						"city_id" => $post["city_id"],
						"branch_image" => $image,
						"branch_address" => $post["branch_address"],
						"branch_phone" => $post["branch_phone"],
						"branch_long" => $post["branch_long"],
						"branch_lat" => $post["branch_lat"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->insert("branch",$input);
			
			$action="Add branch Name " . $post["branch_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_branch");
		endif;
		
		$data["title"]="Add Branch";
		$data["page"]="branch/add";

		$data["city"] = $this->dropdown->set("city","city_id","city_name");
		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 

			if($post["photo_status"]=="1"){
				$config['upload_path'] = "./media/branch/";
				$config['allowed_types'] = "gif|jpg|png|jpeg";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				$file="branch_image";
				
				if ( ! $this->upload->do_upload($file)){
					$image="img_album_default.jpg";
				}else{
					$name=$this->upload->data($file);
					$image=$name['file_name'];
					
					$this->image_resize($image);
					
					
					$input = array(
						"branch_image" => $image
						);
			
					$this->db->where("branch_id",$id);
					$this->db->update("branch",$input);
				}
			}
			
			$input = array(
						"branch_name" => $post["branch_name"],
						"city_id" => $post["city_id"],
						"branch_address" => $post["branch_address"],
						"branch_phone" => $post["branch_phone"],
						"branch_long" => $post["branch_long"],
						"branch_lat" => $post["branch_lat"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("branch_id",$id);
			$this->db->update("branch",$input);
			
			$action="Update branch ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_branch");
		endif;
		
		$data["title"]="Edit Branch";
		$data["page"]="branch/edit";
		$data["city"] = $this->dropdown->set("city","city_id","city_name");		
		$data["get_data"]=$this->admin_branch_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("branch_id",$id);
			$this->db->update("branch",$data);
			
			$action="Delete Branch ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_branch");
	
	}
	
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/branch/'.$image.'';
			$config2['new_image'] = './media/branch/low/'.$image.'';
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
