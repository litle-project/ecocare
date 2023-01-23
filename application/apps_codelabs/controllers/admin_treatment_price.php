<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_treatment_price extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_treatment_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Treatment Pricelist";
		$data["page"]="treatment_price/view";
		if($this->input->post()){
			$post=$this->input->post();
			$data["get_data"]=$this->admin_treatment_model->menu("",$post["branch_id"]);
		}
		else{
			if($this->session->userdata("user_group_id")>1){
				$data["get_data"]=$this->admin_treatment_model->menu();
			}
			else{
				$data["get_data"]=$this->admin_treatment_model->menu();
			}
		}
		
		//print_r("<pre>");
		//print_r($data["get_data"]);
		//print_r("</pre>");
		//echo $this->session->userdata("branch_id");
		$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
		$this->load->view('admin',$data);
	}
	
	function add($id=""){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			
			$input = array(
						"treatment_price" => $post["treatment_price"],
						"treatment_id" => $post["treatment_id"],
						"branch_id" => $post["branch_id"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id"),
					);
			
			$this->db->insert("treatment_price",$input);
			
			$action="Add Treatment Price Name " . $post["treatment_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_treatment_price");
		endif;
		
		$data["title"]="Config Treatment Price";
		$data["page"]="treatment_price/add";
		$data["get_data"]=$this->admin_treatment_model->menu($id);
		$this->load->view('admin',$data);
	}
	
	function edit($id,$id2=""){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			
			
			
			$input = array(
						"treatment_price" => $post["treatment_price"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("treatment_price_id",$post["treatment_price_id"]);
			$this->db->update("treatment_price",$input);
			
			$action="Edit Treatment Price name " . $post["treatment_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_treatment_price");
		endif;
		
		$data["title"]="Edit Treatment";
		$data["page"]="treatment_price/edit";
		$data["get_data"]=$this->admin_treatment_model->menu($id);
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
