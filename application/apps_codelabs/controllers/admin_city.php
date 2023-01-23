<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_city extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_city_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="City";
		$data["page"]="city/view";
		$data["get_data"]=$this->admin_city_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$input = array(
						"city_name" => $post["city_name"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->insert("city",$input);
			
			$action="Add City Name " . $post["city_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_city");
		endif;
		
		$data["title"]="Add City";
		$data["page"]="city/add";

		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$input = array(
						"city_name" => $post["city_name"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("city_id",$id);
			$this->db->update("city",$input);
			
			$action="Edit City ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_city");
		endif;
		
		$data["title"]="Edit City";
		$data["page"]="city/edit";
		$data["get_data"]=$this->admin_city_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("city_id",$id);
			$this->db->update("city",$data);
			
			$action="Delete City ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_city");
	
	}
	

}
