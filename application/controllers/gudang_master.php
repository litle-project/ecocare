<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gudang_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("gudang_model");
	}
	

	public function index()
	{
		
	    $data["data"]	= $this->global_model->get_data("a.*, b.branch_name, b.branch_id","gudang a left join branch b on a.branch_id=b.branch_id"," where a.deleted='0' AND b.deleted = '0' order by a.gudang_id desc")->result_array();
		//$data["data"] = $this->admin_product_model->get_data();
		$data["page"]	= "gudang/view";
		$data["title"]	= "Manage Gudang";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{
		priv('add');
		$data["page"]		= "gudang/add";
		$data["title"]		= "Add Gudang";
		$data["gudang_code"] = $this->global_model->get_data("*, MAX(gudang_code) as code","gudang","order by gudang_code DESC")->result_array();
		$data["branch"]		= $this->global_model->get_data("*", "branch", "where deleted='0'")->result_array();
		$this->load->view('admin',$data);

    	if($this->input->post()){
			$post	= $this->input->post();
			$number_code = explode("-", $post['gudang_code']);
			$input	= array(
				"gudang_code" 		=> $number_code[1],
				"code_string" 		=> $number_code[0],
				"gudang_name" 		=> $post["gudang_name"],
				"gudang_address" 	=> $post["gudang_address"],
				"gudang_lat" 		=> $post["gudang_lat"],
				"gudang_long" 		=> $post["gudang_long"],
				"gudang_zoom" 		=> $post["gudang_zoom"],
				"branch_id" 		=> $post["branch_id"],
				"created_date" 		=> date("Y-m-d H:i:s"),
				"created_by" 		=> $this->session->userdata("admin_id"),					
				);
					
			$this->global_model->save_data($input,"gudang");
                        
			// input log
			$action="Create Gudang ".$post["gudang_name"];
			$this->Aktiviti_log_model->create($action);
			
			redirect("gudang_master");
		}	
		
	}
	

	public function detail($id)
	{
		
	    
		$data["data"] 	= $this->global_model->get_data_join("*", "gudang a", "where gudang_id = '".$id."'", "left join branch as b on b.branch_id = a.branch_id")->result_array();
		$data["page"]	= "gudang/detail";
		$data["title"]	= "Detail Gudang";
		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{
		
	    $data["data"] 		= $this->global_model->get_data("*","gudang"," where deleted='0' AND gudang_id='".$id."' order by gudang_id desc")->result_array();
		$data["branch"]		= $this->global_model->get_data("*", "branch", "where deleted='0'")->result_array();
		$data["page"]		= "gudang/edit";
		$data["title"]		= "Edit Gudang";
		$this->load->view('admin',$data);

		if($this->input->post()){
			$post = $this->input->post();
			$number_code = explode("-", $post['gudang_code']);
			$input=array(
					"gudang_code" 		=> $number_code[1],
					"code_string" 		=> $number_code[0],
					"gudang_name" 		=> $post["gudang_name"],
					"gudang_address" 	=> $post["gudang_address"],
					"gudang_lat" 		=> $post["gudang_lat"],
					"gudang_long" 		=> $post["gudang_long"],
					"gudang_zoom" 		=> $post["gudang_zoom"],
					"branch_id" 		=> $post["branch_id"],
					"update_date" 		=> date("Y-m-d H:i:s"),
					"update_by" 		=> $this->session->userdata("admin_id"),					
				);

				$this->db->where("gudang_id", $id);
				$this->db->update("gudang", $input);
				
				$action="Edit Gudang ". $post["gudang_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("gudang_master");
		}
	}
	
	function delete($id){ 
		$this->global_model->delete_data($id, 'gudang_id', 'gudang');
		redirect("gudang_master");
	}
	

	function stock(){
		$branch_id = $this->input->get("branch_id");
		$gudang_id = $this->input->get("gudang_id");

		$data['title'] 	= 'List Stock Product';
		$data['page'] 	= 'gudang/list_stock';
		$data['data'] 	= $this->gudang_model->get_data($gudang_id, $branch_id);
		
		// echo "<pre>"; print_r($data['data']); die();

		// print_r($data['data']);die();

		$this->load->view('admin', $data);
	}

	function stockAroma(){

		$inventory_id 	= $this->input->get("inventory_id");
		$branch_id		= $this->input->get("branch_id");
		$gudang_id		= $this->input->get("gudang_id");
		$product_id 	= $this->input->get("product_id");

		$data['title'] 	= 'list stock';
		$data['page'] 	= 'gudang/list_aroma_stock';
		$data['data'] 	= $this->gudang_model->get_data_detail($inventory_id, $branch_id, $gudang_id, $product_id);
		// print_r($product_id);die();

		$this->load->view('admin', $data);
	}
}

