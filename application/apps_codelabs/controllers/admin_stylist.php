<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_stylist extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_stylist_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Stylist";
		$data["page"]="stylist/view";
		$data["get_data"]=$this->admin_stylist_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
                        
                        $config['upload_path'] = "./media/stylist/";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			$file="stylist_photo";
			
			if ( ! $this->upload->do_upload($file)){
				$image="img_album_default.jpg";
			}else{
				$name=$this->upload->data($file);
				$image=$name['file_name'];
				
				$this->image_resize($image);
				
			}
                        
			$input = array(
						"stylist_name" => $post["stylist_name"],
						"stylist_desc" => $post["stylist_desc"],
                                                "stylist_photo" => $image,
                                                "stylist_phone" => $post["stylist_phone"],
                                                "branch_id" => $post["branch_id"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->insert("stylist",$input);
			
			$action="Add Stylist Name " . $post["stylist_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_stylist");
		endif;
		
		$data["title"]="Add Stylist";
		$data["page"]="stylist/add";
		$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			if($post["photo_status"]=="1"){
				$config['upload_path'] = "./media/stylist/";
				$config['allowed_types'] = "gif|jpg|png|jpeg";
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				$file="stylist_photo";
				
				if ( ! $this->upload->do_upload($file)){
					$image="img_album_default.jpg";
				}else{
					$name=$this->upload->data($file);
					$image=$name['file_name'];
					
					$this->image_resize($image);
					
					
					$input = array(
						"stylist_photo" => $image
						);
			
					$this->db->where("stylist_id",$id);
					$this->db->update("stylist",$input);
				}
			}
			$input = array(
						"stylist_name" => $post["stylist_name"],
						"stylist_desc" => $post["stylist_desc"],
                                                
                                                "stylist_phone" => $post["stylist_phone"],
                                                "branch_id" => $post["branch_id"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("stylist_id",$id);
			$this->db->update("stylist",$input);
			
			$action="Edit Stylist name " . $post["stylist_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_stylist");
		endif;
		
		$data["title"]="Edit Stylist";
		$data["page"]="stylist/edit";
		$data["get_data"]=$this->admin_stylist_model->get_data($id);
		$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("stylist_id",$id);
			$this->db->update("stylist",$data);
			
			$action="Delete Stylist ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_stylist");
	
	}
        
        function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/stylist/'.$image.'';
			$config2['new_image'] = './media/stylist/low/'.$image.'';
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
