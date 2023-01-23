<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_treatment_category extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_treatment_category_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Treatment Category";
		$data["page"]="treatment_category/view";
		$data["get_data"]=$this->admin_treatment_category_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			
			
			
			$input = array(
						"treatment_category_name" => $post["treatment_category_name"],
						"treatment_category_desc" => $post["treatment_category_desc"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id"),
						);
			
			$this->db->insert("treatment_category",$input);
			
			$action="Add Treatment Category Name " . $post["treatment_category_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_treatment_category");
		endif;
		
		$data["title"]="Add Treatment";
		$data["page"]="treatment_category/add";
		
		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$input = array(
						"treatment_category_name" => $post["treatment_category_name"],
						"treatment_category_desc" => $post["treatment_category_desc"],
						"updated_date" => date("Y-m-d H:i:s"),
						"updated_by" => $this->session->userdata("admin_id"),
						);
			
			$this->db->where("treatment_category_id",$id);
			$this->db->update("treatment_category",$input);
			
			$action="Edit Treatment Category ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_treatment_category");
		endif;
		
		$data["title"]="Edit Treatment Category";
		$data["page"]="treatment_category/edit";
		$data["get_data"]=$this->admin_treatment_category_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("treatment_category_id",$id);
			$this->db->update("treatment_category",$data);
			
			$action="Delete Treatment Category ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_treatment_category");
	
	}

}
