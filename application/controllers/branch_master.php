<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$page = $this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update') or ($page=='update_gudang_image')) priv('edit');
		else if(($page=='delete')or($page=='delete1')) priv('delete');
		else  priv('other');
	}
	public function index()
	{
		priv("view");
	    $data["data"]	= $this->global_model->get_data("*","branch"," where deleted='0' order by branch_id desc")->result_array();
		$data["page"]	= "branch/view";
		$data["title"]	= "Manage Branch";

		$this->load->view('admin',$data);
	}

	function add() {
		$data["page"]="branch/add";
		$data["title"]="Add New Branch";
		if($this->input->post()) {
			$post = $this->input->post();
			$params = array(
				"branch_name" => $post["branch_name"],
				"branch_desc" => $post["branch_desc"],
				"created_date" => date("Y-m-d"),
				"created_by" => $this->session->userdata["admin_id"],
				);
			$this->global_model->save_data($params,"branch");
			$action="Create New Branch ".$post["branch_name"];
			$this->Aktiviti_log_model->create($action);
			redirect("branch_master");
		}
		$this->load->view("admin",$data);
	}

	function edit($id) {
		$data["data"] = $this->global_model->get_data("*","branch"," where branch_id='".$id."' and deleted='0' order by branch_id desc")->result_array();
		$data["page"]="branch/edit";
		$data["title"]="Edit Branch";
		if($this->input->post()) {
			$post = $this->input->post();
			$params = array(
				"branch_name" => $post["branch_name"],
				"branch_desc" => $post["branch_desc"],
				);
			$this->global_model->update_data($id, 'branch_id', $params, 'branch');
			$action="Update Branch ID".$id;
			$this->Aktiviti_log_model->create($action);
			redirect("branch_master");
		}
		$this->load->view("admin",$data);
	}

	function delete($id) {
		$this->global_model->delete_data($id, 'branch_id', 'branch');
		$this->global_model->delete_data($id, 'branch_id', 'gudang');
		redirect("branch_master");
	}
}