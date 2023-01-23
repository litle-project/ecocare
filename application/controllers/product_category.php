<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_category extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		
		$page=$this->uri->segment(2);
		if($page=='') priv('view');
		else if($page=='add') priv('add');
		else if($page=='edit') priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');
	}
	

	public function index()
	{	
		priv('view');		    
		$data["data"]	= $this->global_model->get_data("*","product_category"," where deleted='0' order by category_id desc")->result_array();
		$data["page"]	= "product/category/view";
		$data["title"]	= "Manage Category";

		$this->load->view('admin',$data);
	}
	
	public function detail($id)
	{
		priv('other');
		$data["data"] 	= $this->global_model->get_data("*","product_category", "where category_id='".$id."'")->result_array();
		$data["page"]	= "product/category/detail";
		$data["title"]	= "Category Detail";

		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{	
		priv('edit');		   
		$data["data"] 	= $this->global_model->get_data("*","product_category","where category_id='".$id."'")->result_array();		
		$data["page"]	= "product/category/edit";
		$data["title"]	= "Edit Category";

		$this->load->view('admin',$data);
	
		if($this->input->post()){
			$post=$this->input->post();

			$input["category_name"]	= $post["category_name"];
			$input["category_desc"]	= $post["category_desc"];		
			$input["updated_date"]	= date("Y-m-d H:i:s");
			$input["updated_by"]	= $this->session->userdata("admin_id");
			$input["deleted"]		= '0';
			
			$this->db->where("category_id", $id);
			$this->db->update("product_category", $input);
			
			$action="Edit Category ". $post["category_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("product_category");
		}
	}

}

