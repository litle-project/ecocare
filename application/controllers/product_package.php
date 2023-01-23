\<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_package extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		// $this->load->model("admin_product_model");
		// $this->load->model("package_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add')) priv('add');
		else if(($page=='edit')) priv('edit');
		else if(($page=='delete')) priv('delete');
		else  priv('other');
		
	}
	

	public function index()
	{
		priv("view");	
	    $data["data"]	= $this->global_model->get_data("*","product_package"," where deleted='0' order by package_id desc")->result_array();
		$data["page"]	= "product/package/view";
		$data["title"]	= "Manage Package";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{
		priv('add');
		$data["page"]		= "product/package/add";
		$data["title"]		= "Add New Package";	
		$data["product"]	= $this->global_model->get_data_join("*", "product_master a", "where a.deleted='0'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$this->load->view('admin',$data);

	    if($this->input->post()){
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			// insert package data
			$input = array(
						"package_name" 				=> $post["package_name"],
						"package_desc" 				=> $post["package_desc"],
						"created_date" 				=> date("Y-m-d H:i:s"),
						"created_by" 				=> $this->session->userdata("admin_id"),
					);
					
			// echo "<pre>"; print_r($input); die();
			$this->db->insert("product_package", $input);
			$id = $this->db->insert_id();

			// insert product package
            for($ii=1; $ii<=$post['products']; $ii++){
	            $input_product['package_id'] 		= $id;
	            $input_product['product_id']		= $post['product_id_'.$ii];
	            $input_product['product_qty']		= $post['product_qty_'.$ii];
	            $input_product['total_per_install']	= $post['total_per_install_'.$ii];
	            $input_product['total_per_service']	= $post['total_per_service_'.$ii];
	            $input_product['service_period']	= $post['service_period_'.$ii];
				$this->db->insert("product_package_detail", $input_product);
            }
                        
			// input log
			$action="Create Package ".$post["package_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("product_package");
		}	
		
	}
	
	public function detail($id)
	{
		$data["data"] 				= $this->global_model->get_data('*', 'product_package', 'where package_id = "'.$id.'"')->result_array();
		$data["product"] 			= $this->global_model->get_data_join('*', 'product_package_detail a', 'where a.package_id = "'.$id.'" AND a.deleted = "0"', 'left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id')->result_array();
		// echo "<pre>"; print_r($data['product']); die();
		$data["page"]				= "product/package/detail";
		$data["title"]				= "Detail Package";

		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{
		priv('add');
		$data["page"]			= "product/package/edit";
		$data["title"]			= "Edit Package";
		$data['data']			= $this->global_model->get_data("*", "product_package", "where package_id = '".$id."'")->result_array();
		$data["product"]		= $this->global_model->get_data_join("*", "product_master a", "where a.deleted='0'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$data['detail_product'] 	= $this->global_model->get_data("*", "product_package_detail a", "where a.package_id = '".$id."' AND deleted = '0'")->result_array();
		// echo "<pre>"; print_r($data['detail_product']); die();
		$this->load->view('admin',$data);

		if($this->input->post()){
			$post=$this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
		// insert package data
			$input = array(
						"package_name" 				=> $post["package_name"],
						"package_desc" 				=> $post["package_desc"],
						"created_date" 				=> date("Y-m-d H:i:s"),
						"created_by" 				=> $this->session->userdata("admin_id"),
					);
					
			$this->db->where("package_id", $id);
			$this->db->update("product_package", $input);

			// insert product package
			for($ii=1; $ii<=$post['products']; $ii++){
	            $input_product['package_id'] 		= $id;
	            $input_product['product_id']		= $post['product_id_'.$ii];
	            $input_product['product_qty']		= $post['product_qty_'.$ii];
	            $input_product['total_per_install']	= $post['total_per_install_'.$ii];
	            $input_product['total_per_service']	= $post['total_per_service_'.$ii];
	            $input_product['service_period']	= $post['service_period_'.$ii];
					$this->db->where("package_detail_id", $post['package_detail_id_'.$ii]);
					$this->db->update("product_package_detail", $input_product);
            }
				 // die();
	            
			$action="Update Package ".$post["package_name"];
			$this->Aktiviti_log_model->create($action);			
			
			redirect("product_package");
		}
	}
	
	function delete($id){
		
		$this->global_model->delete_data($id, 'package_id', 'product_package');
		$this->global_model->delete_data($id, 'package_id', 'product_package_detail');
		redirect("product_package");
	}

	function delete_product(){
		
		$product_id 	= $this->input->get('product_id');
		$package_id 	= $this->input->get('package_id');
		$detail_product = $this->global_model->get_data("*", "product_package_detail", "where product_id = '".$product_id."' AND package_id = '".$package_id."' AND deleted = '0'")->result_array();
		// echo "<pre>"; print_r($detail_product); die();
		$this->global_model->delete_data($detail_product[0]['package_detail_id'], 'package_detail_id', 'product_package_detail');
		redirect("product_package/edit/".$package_id."");
	}
	
}

