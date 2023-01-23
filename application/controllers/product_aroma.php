<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_aroma extends CI_Controller {
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
		priv("view");
		$data["data"]  = $this->global_model->get_data_join("*", "product_aroma a", "where a.deleted = '0'", "left join product_master as b on b.product_id = a.product_id")->result_array();
		$data["page"]  = "product/aroma/view";
		$data["title"] = "Manage Product Aroma";

		// echo "<pre>"; print_r($data['data']); die();

		$this->load->view('admin',$data);

	}

	public function add() 
	{
		priv("add");
		$data["page"]	= "product/aroma/add";
		$data["title"]	= "Add New Product Aroma";
		$data['data'] 	= $this->global_model->get_data("*", "product_master", "where category_id='2' AND aroma = '1' AND deleted = '0'")->result_array();
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();

			$sql =	"SELECT * 
					FROM product_aroma 
					WHERE product_aroma_name 	= '".$post['product_aroma_name']."' 
		  			AND product_id 				= '".$post['product_id']."'
		  			AND deleted 		= '0'";
			$result = $this->db->query($sql)->result_array();

		  	if (empty($result)) {
				$input["product_aroma_name"] 	= $post["product_aroma_name"];
				$input["product_id"]			= $post["product_id"];
				$input["deleted"]				= '0';
				$input["created_date"]			= date("Y-m-d H:i:s");
				$input["created_by"]			= $this->session->userdata("admin_id");

				$this->db->insert("product_aroma", $input);
				redirect("product_aroma");
		  	}else{
		  		echo '<script type="text/javascript">alert("Product With Code '.$post["product_aroma_name"].' With Product ID '.$post["product_id"].' Already Added in Database!");</script>';
		  	}
		}
	}

	public function edit($id) // klewang 05 maret 2018
	{
		priv("edit");
		$data["page"] 		= "product/aroma/edit";
		$data["title"]		= "Edit Product Aroma";
		$data['product'] 	= $this->global_model->get_data("*", "product_master", "where category_id='2' AND aroma = '1' AND deleted = '0'")->result_array();
		$data['data']		= $this->global_model->get_data("*", "product_aroma", "where product_aroma_id = '".$id."'")->result_array();
		// print_r($data['data']); die();
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();

			$sql =	"SELECT * 
					FROM product_aroma 
					WHERE product_aroma_name 	= '".$post['product_aroma_name']."'
					AND product_id 				= '".$post['product_id']."'
		  			AND deleted 				= '0'";
			$result = $this->db->query($sql)->result_array();

			if (empty($result)) {
				$input["product_aroma_name"] 	= $post["product_aroma_name"];
				$input["product_id"]			= $post["product_id"];
				$input["deleted"]				= '0';
				$input["created_date"]			= date("Y-m-d H:i:s");
				$input["created_by"]			= $this->session->userdata("admin_id");

				$this->db->where("product_aroma_id", $id);
				$this->db->update("product_aroma", $input);
				redirect("product_aroma");
			}else{
				echo '<script type="text/javascript">alert("Product With Code '.$post["product_aroma_name"].' With Product ID '.$post["product_id"].' Already Added in Database!");</script>';
			}
		}
	}


	function delete($id) {
		priv("delete");
		$this->global_model->delete_data($id, "product_aroma_id", "product_aroma");
		$data_aroma = $this->global_model->get_data("*", "inventory_stock", "where product_aroma_id = '".$id."'")->result_array();

		foreach ($data_aroma as $key) {
			$data_inv = $this->global_model->get_data("*", "inventory", "where inventory_id = '".$key['inventory_id']."'")->result_array();

			// update data in inventory
			$calculate = $data_inv[0]['product_stock']-$key['stock'];
			$input['product_stock'] = $calculate;

			$this->db->where("inventory_id", $data_inv[0]['inventory_id']);
			$this->db->update("inventory", $input);

		}
		$this->global_model->delete_data($id, "product_aroma_id", "inventory_stock");
		
			
		redirect("product_aroma");
	}
}