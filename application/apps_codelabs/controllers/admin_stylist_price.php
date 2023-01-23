<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_stylist_price extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_stylist_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Stylist list";
		$data["page"]="stylist_price/view";
		$data["get_data"]=$this->admin_stylist_model->get_data();
		$this->load->view('admin',$data);
	}
        
        public function view($id)
	{
		priv("view");
		$data["title"]="Stylist price";
		$data["page"]="stylist_price/view_price";
                $data["data"]=$this->admin_stylist_model->get_data($id);
		$data["get_data"]=$this->admin_stylist_model->menu();
                $data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
                
		$this->load->view('admin',$data);
	}
	
	function add($id="",$id2=""){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
                        
                        
                        
			$input = array(
						"stylist_price" => $post["stylist_price"],
                                                "treatment_id" => $post["treatment_id"],
                                                
						"stylist_id" => $post["stylist_id"],
                                                "level_id" => $post["level_id"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->insert("stylist_price",$input);
			
			$action="Add Stylist Name " . $post["stylist_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_stylist_price/view/" . $id2);
		endif;
		
		$data["title"]="Manage Stylist Price";
		$data["page"]="stylist_price/add";
                $data["data"]=$this->admin_stylist_model->get_data($id2);
		$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
                
                $data["level"] = $this->dropdown->set("stylist_level","level_id","stylist_level_name");
		$data["get_data"]=$this->admin_stylist_model->menu($id);
                $this->load->view('admin',$data);
	}
	
	function edit($id="",$id2=""){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$input = array(
						"stylist_price" => $post["stylist_price"],
                                                
                                                
						
                                                "level_id" => $post["level_id"],
						
						"updated_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("stylist_price_id",$post["stylist_price_id"]);
			$this->db->update("stylist_price",$input);
			
			$action="Edit Stylist name " . $post["stylist_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_stylist_price/view/" . $id2);
		endif;
		
		$data["title"]="Edit Stylist";
		$data["page"]="stylist_price/edit";
		$data["data"]=$this->admin_stylist_model->get_data($id2);
		$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
                
                $data["level"] = $this->dropdown->set("stylist_level","level_id","stylist_level_name");
		$data["get_data"]=$this->admin_stylist_model->menu($id);
		$this->load->view('admin',$data);
	}
	
	
	
	
	

}
