<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Teknisi_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
	}
	

	public function index()
	{
	    $data["data"]	= $this->global_model->get_data("*","teknisi_master"," where deleted='0'")->result_array();
		//$data["data"] = $this->admin_product_model->get_data();
		$data["page"]	= "teknisi/view";
		$data["title"]	= "Manage Teknisi";

		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		
		$data["data"] 	= $this->global_model->get_data_join("*", "teknisi_master a", "where teknisi_id = '".$id."'", "left join branch as b on b.branch_id = a.branch_id")->result_array();
		$data["page"]	= "teknisi/detail";
		$data["title"]	= "Detail Teknisi";
		
		$this->load->view('admin',$data);
	}
	
	
	public function add()
	{
		priv('add');
		$data["page"]		= "teknisi/add";
		$data["title"]		= "Add New Teknisi";
		$data["data"]		= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		$this->load->view('admin',$data);

    	if($this->input->post()){
			$post	= $this->input->post();
			$input	= array(
				"teknisi_name" 		=> $post["teknisi_name"],
				"teknisi_type" 		=> $post["teknisi_type"],
				"teknisi_phone" 	=> $post["teknisi_phone"],
				"teknisi_email" 	=> $post["teknisi_email"],
				"teknisi_address" 	=> $post["teknisi_address"],
				"teknisi_lat" 		=> $post["teknisi_lat"],
				"teknisi_long" 		=> $post["teknisi_long"],
				"teknisi_zoom" 		=> $post["teknisi_zoom"],
				"branch_id" 		=> $post["branch_id"],
				"created_date" 		=> date("Y-m-d H:i:s"),
				"created_by" 		=> $this->session->userdata("admin_id"),					
				);
					
			$this->db->insert("teknisi_master", $input);
                        
			// input log
			$action="Create Teknisi ".$post["teknisi_name"];
			$this->Aktiviti_log_model->create($action);
			
			redirect("teknisi_master");
		}	
		
	}
	


	public function edit($id)
	{
		
		$data["data"] 	= $this->global_model->get_data_join("*", "teknisi_master a", "where teknisi_id = '".$id."'", "left join branch as b on b.branch_id = a.branch_id")->result_array();
		$data["branch"]		= $this->global_model->get_data("*", "branch", "where deleted='0'")->result_array();
		$data["page"]		= "teknisi/edit";
		$data["title"]		= "Edit Gudang";
		$this->load->view('admin',$data);

		if($this->input->post()){
			$post = $this->input->post();
			$input	= array(
					"teknisi_name" 		=> $post["teknisi_name"],
					"teknisi_type" 		=> $post["teknisi_type"],
					"teknisi_phone" 	=> $post["teknisi_phone"],
					"teknisi_email" 	=> $post["teknisi_email"],
					"teknisi_address" 	=> $post["teknisi_address"],
					"teknisi_lat" 		=> $post["teknisi_lat"],
					"teknisi_long" 		=> $post["teknisi_long"],
					"teknisi_zoom" 		=> $post["teknisi_zoom"],
					"branch_id" 		=> $post["branch_id"],
					"created_date" 		=> date("Y-m-d H:i:s"),
					"created_by" 		=> $this->session->userdata("admin_id"),					
				);

				$this->db->where("teknisi_id", $id);
				$this->db->update("teknisi_master", $input);
				
				$action="Edit Teknisi ". $post["teknisi_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("teknisi_master");
		}
	}
	
	function delete($id){ 
		$this->global_model->delete_data($id, 'teknisi_id', 'teknisi_master');
		redirect("teknisi_master");
	}
}

