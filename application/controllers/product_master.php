<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("admin_product_model");
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
		priv('view');
		$data["data"]	= $this->global_model->get_data_join("*", "product_master a", "where a.deleted = '0'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$data["page"]	= "product/master/view";
		$data["title"]	= "Manage Product";

		$this->load->view('admin',$data);
	}

	public function detail($id)
	{   
		priv('other');
		$data["data"]	= $this->global_model->get_data_join("*", "product_master a", "where a.product_id = '".$id."'", "left join product_category as c on c.category_id = a.category_id")->result_array();
		$data["aroma"]	= $this->global_model->get_data_join("*", "product_aroma a", "where a.product_id='".$id."'  AND a.deleted = '0'", "left join inventory_stock as b on b.product_aroma_id = a.product_aroma_id")->result_array();
		// print_r($data['data']); die();
		$data["page"]	= "product/master/detail";
		$data["title"]	= "Detail Product";

		$this->load->view('admin',$data);
	}

	public function add() // kelewang (04 oktober 2018)
	{
		priv('add');
		$data["page"]		= "product/master/add";
		$data["title"]		= "Add New Product";
		$data["category"]	= $this->global_model->get_data("*","product_category","where deleted='0'")->result_array();
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// cek data in db
			$sql =	"SELECT * 
					FROM product_master 
					WHERE product_name 	= '".$post['product_name']."' 
		  			AND product_code 	= '".$post['product_code']."'
		  			AND category_id 	= '".$post['category_id']."'
		  			AND aroma 			= '".$post['aroma']."' 
		  			AND deleted 		= '0'";
			$result = $this->db->query($sql)->result_array();
			// validate data to input to db
			if(empty($result)) {
				

				$input["product_name"] 		= $post["product_name"];
				$input["product_code"] 		= $post["product_code"];
				$input["category_id"]  		= $post["category_id"];
				$input["aroma"]				= $post["aroma"];
				$input["created_date"] 		= date("Y-m-d H:i:s");
				$input["created_by"] 		= $this->session->userdata("admin_id");
				$config['upload_path'] 		= './media/product/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('product_image'))
					{
						$file 	= $this->upload->data();				
						$input["product_image"]  = $file["file_name"];		
					}
				else
					{
						$input["product_image"]  = "";		

					}
				$this->db->insert("product_master", $input);

				$action="Create Product ".$post["product_name"];
				$this->Aktiviti_log_model->create($action);

				redirect("product_master");
	            
			} else {
				echo '<script type="text/javascript">alert("Product With Code '.$post["product_code"].' and Product With Name '.$post["product_name"].' Already Added in Database!");</script>';
			}

		}
	}

	public function edit($id) // kelewang (04 oktober 2018)
	{
		priv('edit');
		$data["page"]		= "product/master/edit";
		$data["title"]		= "Edit Product";
		$data["data"]		= $this->global_model->get_data_join("*", "product_master a", "where a.product_id = '".$id."'", "left join product_category as b on b.category_id = a.category_id")->result_array();
		$data["category"]	= $this->global_model->get_data("*","product_category","where deleted='0'")->result_array();
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// cek data in db
			$data = $this->global_model->get_data("*", "product_master a", "where a.product_id = '".$id."'")->result_array();

			$input["product_name"] 		= $post["product_name"];
			$input["product_code"] 		= $post["product_code"];
			$input["updated_date"] 		= date("Y-m-d H:i:s");
			$input["updated_by"] 		= $this->session->userdata("admin_id");
			$config['upload_path'] 		= './media/product/';
			$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('product_image'))
				{
					$file 	= $this->upload->data();				
					$input["product_image"]  = $file["file_name"];		
				}
			else
				{
					$input["product_image"]  = $data[0]['product_image'];		
				}
			$this->db->where("product_id", $id);
			$this->db->update("product_master", $input);

			$action="Change Product ".$post["product_name"];
			$this->Aktiviti_log_model->create($action);

			redirect("product_master");
	            
			

		}
	}

	function delete($id){ // klewang (04 oktober 2018)
		priv("delete");
		
		$this->global_model->delete_data($id, 'product_id', 'product_master');
		$this->global_model->delete_data($id, 'product_id', 'product_aroma');
		$this->global_model->delete_data($id, 'product_id', 'inventory_stock');


		$action="Delete Product With Id ".$id;
    	$this->Aktiviti_log_model->create($action);

		redirect("product_master");
	}


	function import()
	{
		priv('other');
		$data["image_sample"] 	= "sample.png";
		$data["excel_sample"] 	= "import_product_sample6.xlsx";
		$data["control"]		= "product";
		$data["page"]			= "product/master/import/view";
		$data["title"]			= "Import Product";

		if($this->input->post()){
            $fileName 					= $_FILES['import']['name'];
            $config['upload_path'] 		= './media/product/';
            $config['file_name'] 		= $fileName;
            $config['allowed_types'] 	= '*';
            $config['max_size']        	= 10000;

            $this->load->library('upload');
            $this->upload->initialize($config);
            $file = "import";         
            if ( ! $this->upload->do_upload($file)){
                    print_r($this->upload->display_errors());
            }else{
                $name=$this->upload->data($file);
                $image=$name['file_name'];
            }       
            $inputFileName = './media/product/'.$image;
            
            // echo $inputFileName;
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($inputFileName);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            // echo "<pre>";
            // print_r($sheetData);die();
            if(count($sheetData)>0) {
            	foreach ($sheetData as $row) {
        			if(!empty($row["A"])){
        				if ($row != $sheetData[1] && $row != $sheetData[2]) {
        					$input['product_name'] = $row['A'];
        					$input['product_code'] = $row['B'];
        					$input['category_id']  = $row['C'];
        					if ($row['C'] == '1') {
        						$input['aroma'] = 0;
        					}else{
        						$input['aroma'] = $row['D'];
        					}
        					$input['created_date'] = date("Y-m-d H:i:s");
        					$input['created_by']   = $this->session->userdata("admin_id");
        					// echo "<pre>"; print_r($input); die();
        					$this->db->insert("product_master", $input);
						}
					}
				}
			}
            redirect("product_master");
		}
		$this->load->view('admin',$data);
	}
}

