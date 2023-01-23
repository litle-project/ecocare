<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
        $this->load->library("excel");

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
		$data["data"]	= $this->global_model->get_data("*", "customer_master", "where deleted = '0'")->result_array();
		$data["page"]	= "customer/master/view";
		$data["title"]	= "Manage Customer";

		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");   
		$data["data"]		= $this->global_model->get_data("*", "customer_master", "where customer_id = '".$id."'")->result_array();
		$data['address']	= $this->global_model->get_data("*", "customer_address", "where customer_id = '".$id."'")->result_array();
		$data["page"]		= "customer/master/detail";
		$data["title"]		= "Customer Detail";

		$this->load->view('admin',$data);
	}

	function add() {
		priv("add");   
		$data["page"]	= "customer/master/add";
		$data["title"]	= "Add New Customer";
		if($this->input->post()) {
			$post = $this->input->post();
			
			$input = array(
					"customer_name"		=> $post["customer_name"],
					"customer_npwp"		=> $post["customer_npwp"],
					"customer_email"	=> $post["customer_email"],
					"customer_phone"	=> $post["customer_phone"],
					"customer_pic"		=> $post["customer_pic"],
					"created_date"		=> date("Y-m-d H:i:s"),
					"created_by"		=> $this->session->userdata("admin_id"),
					"deleted"			=> "0"
				);
			$this->db->insert("customer_master",$input);
			
			
			$action="Add New Customer ".$post["customer_name"];
			$this->Aktiviti_log_model->create($action);			
			
			redirect("customer_master");
		}

		$this->load->view('admin',$data);
	}

	function edit($customer_id) {
		priv("edit");   
		$data["page"]	= "customer/master/edit";
		$data["title"]	= "Edit Customer";
		$data["data"]	= $this->global_model->get_data("*", "customer_master", "where customer_id = '".$customer_id."'")->result_array();
		if($this->input->post()) {
			$post=$this->input->post();
			
			$input = array(
					"customer_name"		=> $post["customer_name"],
					"customer_npwp"		=> $post["customer_npwp"],
					"customer_email"	=> $post["customer_email"],
					"customer_phone"	=> $post["customer_phone"],
					"customer_pic"		=> $post["customer_pic"],
					"update_date"		=> date("Y-m-d H:i:s"),
					"update_by"			=> $this->session->userdata("admin_id"),
					"deleted"			=> "0"
				);
			$this->db->where("customer_id",$customer_id);
			$this->db->update("customer_master",$input);
			
			$action="Edit Customer ".$post["customer_name"];
			$this->Aktiviti_log_model->create($action);			
			
			redirect("customer_master");
		}

		$this->load->view('admin',$data);
	}

	function delete($customer_id) {
		priv("delete");
		$this->global_model->delete_data($customer_id, "customer_id", "customer_master");
		$this->global_model->delete_data($customer_id, "customer_id", "customer_address");
		// $this->global_model->delete_data($customer_id, "customer_id", "contract_master");
		redirect("customer_master");
	}

	function import()
	{
		priv('add');
		$data["image_sample"]	= "sample.png";
		$data["excel_sample"]	= "sample.xlsx";
		$data["control"]		= "Manage Customer";
		$data["page"]			= "customer/master/import/view";
		$data["title"]			= "Import Customer";
		if($this->input->post()){
            $fileName = $_FILES['import']['name'];
            $config['upload_path'] = './media/customer/';
            $config['file_name'] = $fileName;
            $config['allowed_types'] = '*';
            $config['max_size']        = 10000;

            $this->load->library('upload');
            $this->upload->initialize($config);
            $file="import";         
            if ( ! $this->upload->do_upload($file)){
                    print_r($this->upload->display_errors());
            }else{
                $name=$this->upload->data($file);
                $image=$name['file_name'];
            }       
            $inputFileName = './media/customer/'.$image;
            
            // echo $inputFileName;
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($inputFileName);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            // echo "<pre>";
            // print_r($sheetData);die();
            if(count($sheetData)>1) {
            	foreach ($sheetData as $row) {
        			if(!empty($row["A"])){
        				if ($row != $sheetData[1]) {
        					$input['customer_name'] 	= $row['A'];
        					$input['customer_npwp']		= $row['B'];
        					$input['customer_email']	= $row['C'];
        					$input['customer_phone']	= $row['D'];
        					$input['customer_pic']		= $row['E'];
        					$this->db->insert('customer_master', $input);
        				}
        			}
            	}
            }
            redirect("customer_master");
		}
		$this->load->view('admin',$data);
	}
}

