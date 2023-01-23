<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_address extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
        $this->load->library("excel");
	}

	public function index()
	{
		priv("view");    
		$data["data"]	= $this->global_model->get_data_join("*", "customer_address a", "where a.deleted = '0' AND b.deleted = '0'", "left join customer_master as b on b.customer_id = a.customer_id")->result_array();
		$data["page"]	= "customer/address/view";
		$data["title"]	= "Manage Customer Address";

		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");   
		$data["data"]		= $this->global_model->get_data_join("*", "customer_address a", "where a.address_id = '".$id."'", "left join customer_master as b on b.customer_id = a.customer_id")->result_array();
		$data["page"]		= "customer/address/detail";
		$data["title"]		= "Customer Detail";

		$this->load->view('admin',$data);
	}

	function add() {
		priv("add");
		$data['data']	= $this->global_model->get_data("*", "customer_master", "where deleted = '0'")->result_array();
		$data["page"]	= "customer/address/add";
		$data["title"]	= "Add New Address";
		if($this->input->post()) {
			$post = $this->input->post();
			// print_r($post); die();
			$input = array(
					"customer_id"		=> $post["customer_id"],
					"address"			=> $post["address"],
					"address_lat"		=> $post["address_lat"],
					"address_long"		=> $post["address_long"],
					"address_zoom"		=> $post["address_zoom"],
					"created_date"		=> date("Y-m-d H:i:s"),
					"created_by"		=> $this->session->userdata("admin_id"),
					"deleted"			=> "0"
				);
			$this->db->insert("customer_address",$input);
			
			
			$action="Add New Customer ".$post["customer_id"];
			$this->Aktiviti_log_model->create($action);			
			
			redirect("customer_address");
		}

		$this->load->view('admin',$data);
	}

	function edit($id) {
		priv("edit");   
		$data["page"]	= "customer/address/edit";
		$data["title"]	= "Edit Address";
		$data["data"]	= $this->global_model->get_data_join("*", "customer_address a", "where a.address_id = '".$id."'", "left join customer_master as b on b.customer_id = a.customer_id")->result_array();
		$data["customer"]	= $this->global_model->get_data("*", "customer_master", "where deleted = '0'")->result_array();
		if($this->input->post()) {
			$post=$this->input->post();
			
			$input = array(
					"customer_id"		=> $post["customer_id"],
					"address"			=> $post["address"],
					"address_lat"		=> $post["address_lat"],
					"address_long"		=> $post["address_long"],
					"address_zoom"		=> $post["address_zoom"],
					"created_date"		=> date("Y-m-d H:i:s"),
					"created_by"		=> $this->session->userdata("admin_id"),
					"deleted"			=> "0"
				);
			$this->db->where("address_id",$id);
			$this->db->update("customer_address",$input);
			
			$action="Edit Customer ".$post["customer_id"];
			$this->Aktiviti_log_model->create($action);			
			
			redirect("customer_address");
		}

		$this->load->view('admin',$data);
	}

	function delete($id='') {
		priv("delete");
		$input['deleted'] = '1';
		$this->db->where("address_id",$id);
		$this->db->update("customer_address",$input);
		redirect("customer_address");
	}

	function import()
	{
		priv('add');
		$data["image_sample"]="import_customer_sample2.png";
		$data["excel_sample"]="import_customer_sample3.xlsx";
		$data["file_path"]="customer";
		$data["control"]="customer";
		$data["page"]="contract/import";
		$data["title"]="Import Customer";
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
            /*echo "<pre>";
            print_r($sheetData);die();*/
            $i=1;
            if(count($sheetData)>0) {
            	foreach ($sheetData as $row) {
            		if($i>1){
            			if(!empty($row["A"])){
            				if ($row != $sheetData[1]) {
            					$input1 = array(
            						"member_email"=>$row["E"],
            						"created_date"=>date("Y-m-d"),
            						"created_by"=>$this->session->userdata("admin_id"),
            						"deleted"=>"0"
            					);
            					$insert_id = $this->admin_member_model->insert("member",$input1);
            					$input2 = array(
            						"member_id"=>$insert_id,
            						"member_name"=>$row["A"],
            						"member_name_npwp"=>$row["B"],
            						"member_address"=>$row["C"],
            						"branch_id"=>$row["G"],
            						"member_phone"=>$row["D"],
            						"member_pic"=>$row["F"],
            						"created_date"=>date("Y-m-d H:i:s"),
            						"created_by"=>$this->session->userdata("admin_id"),
            						"deleted"=>"0"
            					);
            					$this->admin_member_model->insert("member_profile",$input2);
            				}
            			}
            		}
            		$i++;
            	}
            }
            redirect("customer");
		}
		$this->load->view('admin',$data);
	}
}

