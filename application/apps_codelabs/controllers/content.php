<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("content_model");
		$this->load->model('Aktiviti_log_model');
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Content";
		$data["page"]="content/view";
		$data["get_data"]=$this->content_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		if($this->input->post()){
			$post=$this->input->post();
			$config['upload_path'] = './media/content/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("content_image"))
			{
				$error = array('error' => $this->upload->display_errors());
				
				print_r("<pre>");
				print_r($error);
				print_r("</pre>");
				//$this->load->view('upload_form', $error);
			}
			else
			{
				$file = $this->upload->data();
				$data=array(
							"content_title" => $post["content_title"],
							"content_desc" => $post["content_desc"],
							"content_category_id" => $post["content_category_id"],
							"content_image" => $file["file_name"],
							"created_date" => date("Y-m-d H:i:s"),
							"created_by" => $this->session->userdata("admin_id")
							);
							
				$this->db->insert("content",$data);
				$action="Create New Content  " . $post['content_title'];
				$this->Aktiviti_log_model->create($action);
			}
				redirect("content");
			
		}
		
		
		
		$data["title"]="Add Content";
		$data["page"]="content/add";
		$data["cat"]=$this->content_model->cat();
		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		if($this->input->post()){
			$post=$this->input->post();
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/content/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("photo");
				
				$file = $this->upload->data();
				$data["content_image"]=$file["file_name"];

			}
				$data["content_title"] = $post["content_title"];
				$data["content_desc"] = $post["content_desc"];
				$data["content_category_id"] = $post["content_category_id"];
				$data["updated_date"] = date("Y-m-d H:i:s");
				$data["updated_by"] = $this->session->userdata("admin_id");
						
						
			$this->db->where("content_id",$id);
			$this->db->update("content",$data);
			
			
			$action="Update Content  " . $post['content_title'];
			$this->Aktiviti_log_model->create($action);
			//print_r($data);
			redirect("content");
			
		}
		
		
		
		$data["title"]="Edit Content";
		$data["page"]="content/edit";
		$data["cat"]=$this->content_model->cat();
		$data["get_data"]=$this->content_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	
	function content_edit($id){
		priv("edit");
		if($this->input->post()){
			$post=$this->input->post();
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/content/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("photo");
				
				$file = $this->upload->data();
				$data["content_image"]=$file["file_name"];

			}
				$data["content_title"] = $post["content_title"];
				$data["content_desc"] = $post["content_desc"];
				
				$data["updated_date"] = date("Y-m-d H:i:s");
				$data["updated_by"] = $this->session->userdata("admin_id");
						
						
			$this->db->where("content_id",$id);
			$this->db->update("content",$data);
			
			
			$action="Update Content  " . $post['content_title'];
			$this->Aktiviti_log_model->create($action);
			//print_r($data);
			redirect("content/content_edit/" . $id);
			
		}
		
		
		
		$data["title"]="Edit Content";
		$data["page"]="content/content";
		//$data["cat"]=$this->content_model->cat();
		$data["get_data"]=$this->content_model->get_site($id);
		$this->load->view('admin',$data);
	}
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("content_id",$id);
			$this->db->update("content",$data);
			
			$action="Delete Content ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("content");
	
	}
	

}
