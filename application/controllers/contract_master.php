<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contract_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("contract_model");
		$this->load->model("admin_product_model");
		$this->load->library('excel');
		$page=$this->uri->segment(2);
	}
	

	public function index()
	{			    
		priv("view");
		$data["data"] = $this->contract_model->get_data();
		$data["page"]	="contract/master/view";
		$data["title"]	= "Manage Contract";
		// echo"<pre>"; print_r($data['data']); die();
		$this->load->view('admin',$data);
	}


	public function detail($id)
	{
		priv("view");
		$pdf 						= $this->input->post('pdf');
		$data["data"] 				= $this->global_model->get_data_join("*", "contract a", "where a.contract_id = '".$id."'", "left join customer_master as b on b.customer_id = a.customer_id left join customer_address as c on c.customer_id = b.customer_id")->result_array();
		$data["detail_product"] 	= $this->contract_model->get_contract_product($id);
		// echo "<pre>"; print_r($data['detail_product']); die();
		$data["detail_package"] 	= $this->contract_model->get_contract_package($id);
		$data["page"]				= "contract/master/print/report_pdf";
		$data["title"]				= "Contract Detail";
		if (($pdf)) {
            $this->_to_pdf($data);
        }

		$this->load->view('admin',$data);
	}

	function _to_pdf($all_data = array()) {
        $this->load->library('pdf_exporter', '', 'pdf');
        $view = $this->load->view('admin/contract/master/print/print_contract', $all_data, TRUE);
        // print_r($view);die();
        $this->pdf->output_pdf($view, $all_data["title"] . '.pdf');
    }

	function print_ia($contract_id) {
        priv("view");
        $data["print"] 			= FALSE;
        $pdf 					= $this->input->post('pdf');
        $data["title"]			= "Instalation Acknowledgement";
        $data["page"]			= "contract/master/print/print_ia";           
        $data["data_product"] 	= $this->contract_model->get_contract_product($contract_id);
        $data["data_package"] 	= $this->contract_model->get_contract_package($contract_id);
        $data["data_customer"] 	= $this->contract_model->get_data($contract_id);
        // echo "<pre>"; print_r($data['data_customer']); die();
        if (($pdf)) {
            $data["print"] = TRUE;
            $this->_to_pdf_ia($data);
        }
        $this->load->view("admin",$data);
    }
	
	function _to_pdf_ia($all_data = array()) {
        $this->load->library('pdf_exporter', '', 'pdf');
        $view = $this->load->view('admin/contract/master/print/print_ia', $all_data, TRUE);
        $this->pdf->output_pdf($view, $all_data["title"] . '.pdf');
    }

	public function add()
	{
		$data['branch'] 	= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		$data['customer'] 	= $this->global_model->get_data("*", "customer_master", "where deleted = '0'")->result_array();
		$data['product']	= $this->global_model->get_data_join("*", "product_master a", "where a.deleted = '0'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$data['package']	= $this->global_model->get_data("*", "product_package a", "where a.deleted = '0'")->result_array();
		// print_r($data['package']); die();
		$data["page"]		= "contract/master/add";
		$data["title"]		= "Add Contract";
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();
			$check = $this->global_model->get_data('*','contract','where deleted="0" AND contract_no ="'.$post["contract_no"].'"')->result_array();

			if(empty($check)){
				$date = date("Y-m-d", strtotime($post['contract_date']));
				$input=array(
						"contract_no"		=> $post["contract_no"],
						"branch_id"			=> $post["branch_id"],
						"contract_date"		=> $date,
						"contract_purpose"	=> $post["contract_purpose"],
						"contract_period"	=> $post["contract_period"],
						"customer_id"		=> $post["customer_id"],
						"address_id" 		=> $post["address_id"],
						"contract_payment" 	=> $post["contract_payment"],
						"contract_note" 	=> $post["contract_note"],
						"created_date" 		=> date("Y-m-d H:i:s"),
						"created_by" 		=> $this->session->userdata("admin_id")
					);
				$this->db->insert("contract",$input);
				$id=$this->db->insert_id();

				$product = $this->input->get_post("product");
				if(count($product) > 0 && !empty($product)){
		             for($i=0;$i<count($product);$i++){

		                $data[$i]["contract_id"] 	= $id;
		                $data[$i]["contract_type"] 	= "2";
		                $data[$i]["package_id"] 	= "0";
		                $data[$i]["product_id"] 	= $product[$i];
		                $data[$i]["amount"] 		= $post["number_of_product".$product[$i]];
		                $data[$i]["price"] 			= $post["price".$product[$i]];
		                $data[$i]["created_date"] 	= date("Y-m-d H:i:s");
		                $data[$i]["created_by"] 	= $this->session->userdata("admin_id");
		                
		                $this->db->insert("contract_detail", $data[$i]);
		            }
		        }

				$package = $this->input->get_post("package");
				if(count($package) > 0 && !empty($package)){
		             for($i=0;$i<count($package);$i++){

		             	$contract_package[$i]["contract_id"] 			= $id;
		                $contract_package[$i]["contract_type"] 			= "1";
		                $contract_package[$i]["package_id"] 			= $package[$i];
		                $contract_package[$i]["product_id"] 			= "0";
		                $contract_package[$i]["price"] 					= $post['price'][$i];
		                $contract_package[$i]["product_package_qty"] 	= $post["number_of_package".$package[$i]];
		                $contract_package[$i]["created_by"] 			= $this->session->userdata("admin_id");
			            $contract_package[$i]["created_date"] 			= date("Y-m-d H:i:s");		
		             	
		                $this->db->insert("contract_detail", $contract_package[$i]);
		            }
		        }

				// input log
				$action="Create Contract ".$post["contract_name"];
				$this->Aktiviti_log_model->create($action);			
			
				redirect("contract_master");
			}else{
				echo "<script>alert('Contract is already exist!');</script>";
			}

		}
	}

	function edit($id){
		priv("edit");
		$data['data'] 		= $this->global_model->get_data("*", "contract", "where contract_id = '".$id."'")->result_array();
		$data['branch'] 	= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		$data['customer'] 	= $this->global_model->get_data("*", "customer_master", "where deleted = '0'")->result_array();
		$data['package']	= $this->global_model->get_data("*", "product_package a", "where a.deleted = '0'")->result_array();
		$data['product']	= $this->global_model->get_data_join("*", "product_master a", "where a.deleted = '0'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$data['detail_product']	= $this->global_model->get_data("*", "contract_detail", "where contract_id = '".$id."' and contract_type = '2' and deleted = '0'")->result_array();
		$data['detail_package']	= $this->global_model->get_data("*", "contract_detail", "where contract_id = '".$id."' and contract_type = '1' and deleted = '0'")->result_array();
		// echo "<pre>"; print_r($data['detail_package']); die();
		$data["page"]	= "contract/master/edit";
		$data["title"]	= "Edit Contract";
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();
			$contract = $this->global_model->get_data('*','contract','where contract_id = "'.$id.'"')->result_array();

			$date = date("Y-m-d", strtotime($post['contract_date']));
			$input=array(
					"contract_no"		=> $post["contract_no"],
					"branch_id"			=> $post["branch_id"],
					"contract_date"		=> $date,
					"contract_purpose"	=> $post["contract_purpose"],
					"contract_period"	=> $post["contract_period"],
					"customer_id"		=> $post["customer_id"],
					"contract_payment" 	=> $post["contract_payment"],
					"contract_note" 	=> $post["contract_note"],
					"created_date" 		=> date("Y-m-d H:i:s"),
					"created_by" 		=> $this->session->userdata("admin_id")
				);
			if (!empty($post['address_id'])) {
				$input['address_id'] = $post['address_id'];
			}else{
				$input['address_id'] = $contract[0]['address_id'];
			}
			$this->db->where("contract_id", $id);
			$this->db->update("contract", $input);

			$product = $this->input->get_post("product");
				if(count($product) > 0 && !empty($product)){
		            for($i=0;$i<count($product);$i++){
						$data_product = $this->global_model->get_data('*', 'contract_detail', 'where product_id = "'.$product[$i].'" and contract_id = "'.$id.'" and deleted = "0"')->result_array();
						if (empty($data_product)) {
			                $data[$i]["contract_id"] 	= $id;
			                $data[$i]["contract_type"] 	= "2";
			                $data[$i]["package_id"] 	= "0";
			                $data[$i]["product_id"] 	= $product[$i];
			                $data[$i]["amount"] 		= $post["number_of_product".$product[$i]];
			                $data[$i]["price"] 			= $post["price".$product[$i]];
			                $data[$i]["created_date"] 	= date("Y-m-d H:i:s");
			                $data[$i]["created_by"] 	= $this->session->userdata("admin_id");
			                
			                $this->db->insert("contract_detail", $data[$i]);
						}else{
							$data[$i]["contract_id"] 	= $id;
			                $data[$i]["contract_type"] 	= "2";
			                $data[$i]["package_id"] 	= "0";
			                $data[$i]["product_id"] 	= $product[$i];
			                $data[$i]["amount"] 		= $post["number_of_product".$product[$i]];
			                $data[$i]["price"] 			= $post["price".$product[$i]];
			                $data[$i]["created_date"] 	= date("Y-m-d H:i:s");
			                $data[$i]["created_by"] 	= $this->session->userdata("admin_id");
			                
			                $this->db->where("contract_detail_id", $data_product[$i]['contract_detail_id']);
			                $this->db->update("contract_detail", $data[$i]);
						}
						// echo "<pre>"; print_r($data_product); die();
		            }
		        }

			$package = $this->input->get_post("package");
				if(count($package) > 0 && !empty($package)){
		             for($i=0;$i<count($package);$i++){
		             	$data_package = $this->global_model->get_data('*', 'contract_detail', 'where package_id = "'.$package[$i].'" and contract_id = "'.$id.'" and deleted = "0"')->result_array();
		             	if (empty($data_package)) {
			             	$contract_package[$i]["contract_id"] 			= $id;
			                $contract_package[$i]["contract_type"] 			= "1";
			                $contract_package[$i]["package_id"] 			= $package[$i];
			                $contract_package[$i]["product_id"] 			= "0";
			                $contract_package[$i]["price"] 					= $post['price'][$i];
			                $contract_package[$i]["product_package_qty"] 	= $post["number_of_package".$package[$i]];
			                $contract_package[$i]["created_by"] 			= $this->session->userdata("admin_id");
				            $contract_package[$i]["created_date"] 			= date("Y-m-d H:i:s");		
			             	
			                $this->db->insert("contract_detail", $contract_package[$i]);
		             	}else{
		             		$contract_package[$i]["contract_id"] 			= $id;
			                $contract_package[$i]["contract_type"] 			= "1";
			                $contract_package[$i]["package_id"] 			= $package[$i];
			                $contract_package[$i]["product_id"] 			= "0";
			                $contract_package[$i]["price"] 					= $post['price'][$i];
			                $contract_package[$i]["product_package_qty"] 	= $post["number_of_package".$package[$i]];
			                $contract_package[$i]["created_by"] 			= $this->session->userdata("admin_id");
				            $contract_package[$i]["created_date"] 			= date("Y-m-d H:i:s");		
			             	
			                $this->db->where("contract_detail_id", $data_package[$i]['contract_detail_id']);
			                $this->db->update("contract_detail", $contract_package[$i]);
		             	}
		            }
		        }

			// input log
			$action="Edit Contract ".$post["contract_name"];
			// $this->Aktiviti_log_model->create($action);			
		
			redirect("contract_master");
		}

	}

	function delete($id) {
        priv("delete");
        $this->global_model->delete_data($id, "contract_id", "contract");
        $this->global_model->delete_data($id, "contract_id", "contract_detail");
        $this->global_model->delete_data($id, "contract_id", "contract_schedule");
        $this->global_model->delete_data($id, "contract_id", "contract_teknisi");
        $this->global_model->delete_data($id, "contract_id", "contract_installer");
        $this->global_model->delete_data($id, "contract_id", "contract_history");
        $this->global_model->delete_data($id, "contract_id", "contract_history_aroma");
        $this->global_model->delete_data($id, "contract_id", "contract_history_product");
        $this->global_model->delete_data($id, "contract_id", "log_termination");
        $this->global_model->delete_data($id, "contract_id", "log_return");
        redirect("contract_master");
    }

    public function delete_product()
    {
    	$product_id = $this->input->get('product_id');
    	$contract_id = $this->input->get('contract_id');
    	$detail_product = $this->global_model->get_data('*', 'contract_detail', 'where product_id = "'.$product_id.'" and contract_id = "'.$contract_id.'"')->result_array();
        
        $this->global_model->delete_data($detail_product[0]['contract_detail_id'], "contract_detail_id", "contract_detail");
        redirect('contract_master/edit/'.$contract_id.'');
    }

    public function delete_package()
    {
    	$package_id = $this->input->get('package_id');
    	$contract_id = $this->input->get('contract_id');
    	$detail_product = $this->global_model->get_data('*', 'contract_detail', 'where package_id = "'.$package_id.'" and contract_id = "'.$contract_id.'"')->result_array();
        
        $this->global_model->delete_data($detail_product[0]['contract_detail_id'], "contract_detail_id", "contract_detail");
        redirect('contract_master/edit/'.$contract_id.'');
    }

    function renew($id){
		priv("edit");
		$data['data'] 		= $this->global_model->get_data("*", "contract", "where contract_id = '".$id."'")->result_array();
		$data['branch'] 	= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		$data['customer'] 	= $this->global_model->get_data("*", "customer_master", "where deleted = '0'")->result_array();
		$data['package']	= $this->global_model->get_data("*", "product_package a", "where a.deleted = '0'")->result_array();
		$data['product']	= $this->global_model->get_data_join("*", "product_master a", "where a.deleted = '0'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$data['detail_product']	= $this->global_model->get_data("*", "contract_detail", "where contract_id = '".$id."' and contract_type = '2'")->result_array();
		$data['detail_package']	= $this->global_model->get_data("*", "contract_detail", "where contract_id = '".$id."' and contract_type = '1' and deleted = '0'")->result_array();
		$data["page"]	= "contract/master/renew/view";
		$data["title"]	= "Renew Contract";
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();
			$contract = $this->global_model->get_data('*','contract','where contract_id = "'.$id.'"')->result_array();

			$date = date("Y-m-d", strtotime($post['contract_date']));
			$input=array(
					"renew"				=> "1",
					"contract_no"		=> $post["contract_no"],
					"branch_id"			=> $post["branch_id"],
					"contract_date"		=> $date,
					"contract_purpose"	=> $post["contract_purpose"],
					"contract_period"	=> $post["contract_period"],
					"customer_id"		=> $post["customer_id"],
					"contract_payment" 	=> $post["contract_payment"],
					"contract_note" 	=> $post["contract_note"],
					"created_date" 		=> date("Y-m-d H:i:s"),
					"created_by" 		=> $this->session->userdata("admin_id")
				);
			if (!empty($post['address_id'])) {
				$input['address_id'] = $post['address_id'];
			}else{
				$input['address_id'] = $contract[0]['address_id'];
			}
			$this->db->where("contract_id", $id);
			$this->db->update("contract", $input);

			$product = $this->input->get_post("product");
				if(count($product) > 0 && !empty($product)){
		            for($i=0;$i<count($product);$i++){
						$data_product = $this->global_model->get_data('*', 'contract_detail', 'where product_id = "'.$product[$i].'" and contract_id = "'.$id.'" and deleted = "0"')->result_array();
						if (empty($data_product)) {
			                $data[$i]["contract_id"] 	= $id;
			                $data[$i]["contract_type"] 	= "2";
			                $data[$i]["package_id"] 	= "0";
			                $data[$i]["product_id"] 	= $product[$i];
			                $data[$i]["amount"] 		= $post["number_of_product".$product[$i]];
			                $data[$i]["price"] 			= $post["price".$product[$i]];
			                $data[$i]["created_date"] 	= date("Y-m-d H:i:s");
			                $data[$i]["created_by"] 	= $this->session->userdata("admin_id");
			                
			                $this->db->insert("contract_detail", $data[$i]);
						}else{
							$data[$i]["contract_id"] 	= $id;
			                $data[$i]["contract_type"] 	= "2";
			                $data[$i]["package_id"] 	= "0";
			                $data[$i]["product_id"] 	= $product[$i];
			                $data[$i]["amount"] 		= $post["number_of_product".$product[$i]];
			                $data[$i]["price"] 			= $post["price".$product[$i]];
			                $data[$i]["created_date"] 	= date("Y-m-d H:i:s");
			                $data[$i]["created_by"] 	= $this->session->userdata("admin_id");
			                
			                $this->db->where("contract_detail_id", $data_product[$i]['contract_detail_id']);
			                $this->db->update("contract_detail", $data[$i]);
						}
						// echo "<pre>"; print_r($data_product); die();
		            }
		        }

			$package = $this->input->get_post("package");
				if(count($package) > 0 && !empty($package)){
		             for($i=0;$i<count($package);$i++){
		             	$data_package = $this->global_model->get_data('*', 'contract_detail', 'where package_id = "'.$package[$i].'" and contract_id = "'.$id.'" and deleted = "0"')->result_array();
		             	if (empty($data_package)) {
			             	$contract_package[$i]["contract_id"] 			= $id;
			                $contract_package[$i]["contract_type"] 			= "1";
			                $contract_package[$i]["package_id"] 			= $package[$i];
			                $contract_package[$i]["product_id"] 			= "0";
			                $contract_package[$i]["price"] 					= $post['price'][$i];
			                $contract_package[$i]["product_package_qty"] 	= $post["number_of_package".$package[$i]];
			                $contract_package[$i]["created_by"] 			= $this->session->userdata("admin_id");
				            $contract_package[$i]["created_date"] 			= date("Y-m-d H:i:s");		
			             	
			                $this->db->insert("contract_detail", $contract_package[$i]);
		             	}else{
		             		$contract_package[$i]["contract_id"] 			= $id;
			                $contract_package[$i]["contract_type"] 			= "1";
			                $contract_package[$i]["package_id"] 			= $package[$i];
			                $contract_package[$i]["product_id"] 			= "0";
			                $contract_package[$i]["price"] 					= $post['price'][$i];
			                $contract_package[$i]["product_package_qty"] 	= $post["number_of_package".$package[$i]];
			                $contract_package[$i]["created_by"] 			= $this->session->userdata("admin_id");
				            $contract_package[$i]["created_date"] 			= date("Y-m-d H:i:s");		
			             	
			                $this->db->where("contract_detail_id", $data_package[$i]['contract_detail_id']);
			                $this->db->update("contract_detail", $contract_package[$i]);
		             	}
		            }
		        }

			// input log
			$action="Edit Contract ".$post["contract_name"];
			// $this->Aktiviti_log_model->create($action);			
		
			redirect("contract_master");
		}

	}

    function cek_contract(){
		$id = $this->input->post('contract_no');
		$check = $this->global_model->get_data("*", "contract", "where contract_no='".$id."' and deleted = '0'")->result_array();
		// print_r($check);
		if (empty($check)) {
			echo "<span style='color: #03889c;'>Contract Is Empty, You Can Continue Create This Contract</span>";
		}else{
			echo "<span style='color: #ff4747;'>The Contract Is Already In The Database</span>";
			echo "<script>alert('Contract Was Added In Database!');</script>";
		}
		
	}

	function get_address($id){
		$address = $this->global_model->get_data("*", "customer_address", "where customer_id='".$id."' and deleted = '0'")->result_array();
		if (!empty($address)) {
			foreach ($address as $key) {
				echo "<option value='".$key['address_id']."'>".$key['address']."</option>";
			}
		}else{
			echo "<script>alert('Please Create Address For This Customer');</script>";
			echo "<option value=''>---- Please Select ----</option>";
		}
		
	}

	public function detail_package($id)
	{
		$data['data']	= $this->global_model->get_data('*', 'product_package', 'where package_id = "'.$id.'"')->result_array();
		$data['product']	= $this->global_model->get_data_join('*', 'product_package_detail a', 'where a.package_id = "'.$id.'" AND a.deleted ="0" group by a.product_id', 'left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id')->result_array();
		$data["page"]	= "contract/master/detail_package";
		$data["title"]	= "Detail Package";
		$this->load->view('admin',$data);
	}

	public function import()
	{
		priv('add');
		//echo "here";
		if($this->input->post()){
		    $fileName = $_FILES['import']['name'];
            $config['upload_path'] = './media/contract/'; 
            $config['file_name'] = $fileName;
            $config['allowed_types'] = '*';
            $config['max_size']        = 10000;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if(! $this->upload->do_upload('import') )
                $this->upload->display_errors();

            $media = $this->upload->data('import');
                    $config['upload_path'] = "./media/contract/";
            $config['allowed_types'] = "*";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);		

		    $file="import";
            if ( ! $this->upload->do_upload($file)){
                    print_r($this->upload->display_errors());
                    $image="sample.xlsx";
            }else{
                $name=$this->upload->data($file);
                $image=$name['file_name'];
                // echo "here";
            }           
            $inputFileName = './media/contract/'.$image;
            
            // echo $inputFileName;
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($inputFileName);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            // echo "<pre>"; print_r($sheetData); die();
            if(count($sheetData)>1) {
            	foreach ($sheetData as $row) {
        			if ($row != $sheetData[5]) {
            			if(!empty($row["A"])){
            				$input["contract_no"] = $row["A"];
            				$input["branch_id"] = $row["B"];
            				$input["contract_date"] = $row["C"];
            				$input["contract_purpose"] = $row["D"];
            				$input["customer_id"] = $row["E"];
            				$input["address_id"] = $row["F"];
            				$input["contract_period"] = $row["G"];
            				$input["contract_payment"] = $row["H"];
            				if (!empty($input['contract_note'])) {
	            				$input["contract_note"] = $row["I"];
            				}else{
            					$input["contract_note"] = '';
            				}
            				$input["created_date"] = date("Y-m-d H:i:s");
            				$input["created_by"] = $this->session->userdata("admin_id");
            				$input["deleted"] = "0";
            				// echo "<pre>"; print_r($input); die();
            				$this->db->insert('contract', $input);
            				$id = $this->db->insert_id();
            				if(!empty($row["J"])){
            					$product_id = explode(",", $row["J"]);
            					$product_amount = explode(",", $row["K"]);
            					$product_price = explode(",", $row["L"]);
            					$product_num = count($product_id);
            					if($product_num>0) {
            						for($i=0;$i<$product_num;$i++) {
            							$input_detail["contract_id"] = $id;
            							$input_detail["contract_type"] = "2";
            							$input_detail["product_id"] = $product_id[$i];
            							$input_detail["amount"] = $product_amount[$i];
            							$input_detail["price"] = $product_price[$i];
            							$input_detail["package_id"] = "0";
            							$input_detail["created_date"] = date("Y-m-y H:i:s");
            							$input_detail["created_by"] = $this->session->userdata("admin_id");
            							$input_detail["deleted"] = "0";
            							$this->db->insert("contract_detail",$input_detail);
            						}
            					}
            				}
	            			if(!empty($row["M"])){
	            				$package_id = explode(",", $row["M"]);
	            				$package_price = explode(",", $row["N"]);
	            				$package_amount = explode(",", $row["O"]);
	            				$package_num = count($package_id);
	            				if($package_num>0) {
	            					for($i=0;$i<$package_num;$i++){
	            						$input_detail1["contract_id"] = $id;
	            						$input_detail1["contract_type"] = "1";
	            						$input_detail1["package_id"] = $package_id[$i];
	            						$input_detail1["product_package_qty"] = $package_amount[$i];
	            						$input_detail1["amount"] = '0';
	            						$input_detail1["price"] = $package_price[$i];
	            						$input_detail1["created_date"] = date("Y-m-y H:i:s");
	            						$input_detail1["created_by"] = $this->session->userdata("admin_id");
	            						$input_detail1["deleted"] = "0";		
	            						$this->db->insert('contract_detail', $input_detail1);
	            					}
	            				}
	            			}
            			}
            		}
            	}
            }
            redirect("contract_master");
		}
		$data["image_sample"]	= "sample.png";
		$data["excel_sample"]	= "sample.xlsx";
		$data["file_path"]		= "contract";
		$data["control"]		= "Contract";
		$data["page"]			= "contract/master/import/view";
		$data["title"]			= "Import Contract";
		$this->load->view('admin',$data);
	}
}