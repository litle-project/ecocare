<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_model");
		//$this->load->model('Aktiviti_log_model');
	}
	
	public function index()
	{
		$data["title"]="Dashboard";
		$data["page"]="admin";
		$this->load->view('admin',$data);
	}
	
	
	function content($id){
		//echo "1";
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
			redirect("content/edit_content/" . $id);
			
		}
		
		
		
		$data["title"]="Edit Content";
		$data["page"]="content/content";
		//$data["cat"]=$this->admin_model->cat();
		$data["get_data"]=$this->admin_model->get_site($id);
		$this->load->view('admin',$data);
	}
}
