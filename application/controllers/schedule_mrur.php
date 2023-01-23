<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_mrur extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("schedule_mrur_model");
		$this->load->model("global_model");
	}

	public function index()
	{	
		priv("view");
		date_default_timezone_set('Asia/Bangkok');
		$date 				= date("Y-m-d");
		$schedule_start 	= date("Y-m-d",strtotime('monday this week'));
		$schedule_end 		= date( "Y-m-d", strtotime('friday next week'));
		$data["page"]		= "schedule/mrur/view";
		$data["title"]		= "Manage Summary MR/UR Today";
		$data["data"] 		= $this->schedule_mrur_model->get_data_today($date);
		$data["date"] 		= $this->schedule_mrur_model->get_data_next_week($schedule_start,$schedule_end);
        $this->load->view('admin',$data);
	}

	public function detail()
	{	
		priv("view");

		$id 				= $this->input->get("contract_id");
        $schedule_id 		= $this->input->get("contract_schedule_id");
		$parent_schedule_id = $this->input->get("parent_schedule_id");

		$data["page"]		= "schedule/mrur/detail";
		$data["title"]		= "Summary MR/UR Detail";
		$data['data']      	= $this->global_model->get_data_join("*", "contract_schedule a", "where a.contract_id = '".$id."' and contract_schedule_id = '".$schedule_id."'", "left join contract as b on b.contract_id = a.contract_id")->result_array();
        $data['installer'] 	= $this->global_model->get_data_join("*", "contract_installer a", "where a.contract_schedule_id = '".$parent_schedule_id."' and b.teknisi_type = '1'", "left join teknisi_master as b on b.teknisi_id = a.installer_id")->result_array();
        $data['teknisi']   	= $this->global_model->get_data_join("*", "contract_teknisi a", "where a.contract_schedule_id = '".$parent_schedule_id."' and b.teknisi_type = '2'", "left join teknisi_master as b on b.teknisi_id = a.teknisi_id")->result_array();
  		$data['product'] 	= $this->global_model->get_data_join("*", "contract_schedule_detail a", "where a.contract_schedule_id = '".$parent_schedule_id."' AND product_type = '2'", "left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id")->result_array();
        $data['package'] 	= $this->global_model->get_data_join("a.*, b.package_id, b.package_name", "contract_schedule_detail a", "where a.contract_schedule_id = '".$parent_schedule_id."' and product_type = '1'", "left join product_package as b on b.package_id = a.package_id")->result_array();
        // echo "<pre>"; print_r($data['installer']); die();
        $this->load->view('admin',$data);
	}

	public function detail_request()
    {
        priv('other');
        $data["page"]           = "schedule/mrur/detail_request";
        $data["title"]          = "Detail Request";
        $id                     = $this->input->get('package_id');
        $contract_id            = $this->input->get('contract_id');
        $schedule_id            = $this->input->get("contract_schedule_id");
        $data['schedule']  = $this->input->get('schedule_type');
        $data['contract']       = $this->global_model->get_data('*', 'contract', 'where contract_id = "'.$contract_id.'"')->result_array();
        $data['data']      = $this->global_model->get_data_join("*", "contract_schedule a", "where a.contract_id = '".$contract_id."' and contract_schedule_id = '".$schedule_id."'", "left join contract as b on b.contract_id = a.contract_id")->result_array();
        $data['package']        = $this->global_model->get_data_join('*','product_package_detail a', 'where a.package_id = "'.$id.'" and b.deleted = "0"', "left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id")->result_array();
        // echo "<pre>"; print_r($data['data']); die();
        $this->load->view('admin',$data);

    }

	function request_material(){
		
		$contract_id 			= $this->input->get("contract_id");
		$parent_schedule_id 	= $this->input->get("parent_schedule_id");
		$contract_schedule_id 	= $this->input->get("contract_schedule_id");

		//untuk ngecek apakah udah di request apa belum
		$check 		= $this->global_model->get_data("*","contract_history","where contract_id = '".$contract_id."' and contract_schedule_id = '".$contract_schedule_id."'")->result_array(); 
        $get_schedule      = $this->global_model->get_data_join("*", "contract_schedule a", "where a.contract_id = '".$contract_id."' and contract_schedule_id = '".$contract_schedule_id."'", "left join contract as b on b.contract_id = a.contract_id")->result_array();
			// product 
		$product 	= $this->global_model->get_data("*", "contract_schedule_detail a", "where a.contract_schedule_id = '".$parent_schedule_id."' and product_type = '2'")->result_array();
		$product_qty			= $this->global_model->get_data("SUM(product_qty) as total_product", "contract_schedule_detail", "where contract_schedule_id = '".$parent_schedule_id."' AND product_type = '2'")->result_array();
			// package
		$get_package			= $this->global_model->get_data("*", "contract_schedule_detail", "where contract_schedule_id = '".$parent_schedule_id."' and product_type = '1'")->result_array();
		

		
		// echo "<pre>"; print_r($get_schedule); die();
		// this is for get qty product in some package (NICE)
		$qty_install = 0;
		$qty_service = 0;
		if(!empty($get_package)) {
			foreach ($get_package as $row) {
				$package = $this->global_model->get_data('*', 'product_package_detail', 'where package_id = "'.$row['package_id'].'" AND deleted = "0"')->result_array();
				if (!empty($package)) {
					foreach ($package as $value) {
						$total_install = $row['package_qty']*$value['total_per_install'];
						$total_service = $row['package_qty']*$value['total_per_service'];

						$qty_install += $total_install;
						$qty_service += $total_service;
					
						// echo "<pre>"; print_r($qty_install);
						
					}
				}
			}
		}

		if ($get_schedule[0]['schedule_type'] == '1' ) { // install
			$qty_request = $product_qty[0]['total_product']+$qty_install;
		}elseif($get_schedule[0]['schedule_type'] == '2'){ // service
			$qty_request = $product_qty[0]['total_product']+0;
		}elseif ($get_schedule[0]['schedule_type'] == '3' ) { // termination
			$qty_request = $product_qty[0]['total_product']+$qty_install;
		}elseif ($get_schedule[0]['schedule_type'] == '4' ) { // complaint
			$qty_request = $product_qty[0]['total_product']+$qty_install;
		}elseif ($get_schedule[0]['schedule_type'] == '5' ) { //request
			$qty_request = $product_qty[0]['total_product']+$qty_install;
		}


		// die();
		// echo "<pre>"; print_r($get_package); die();
		if(empty($check)){
			
			// input history contract
			$input_contract = array(
				'contract_id' 			=> $contract_id,
				'contract_schedule_id' 	=> $contract_schedule_id,
				'total_product'			=> $qty_request,
				'status'				=> '0',
				'created_date'			=> date('Y-m-d'),
				'created_by' 			=> $this->session->userdata("admin_id"),
				'deleted' 				=> '0',
				);
			$this->db->insert('contract_history', $input_contract);
			$history_id = $this->db->insert_id();

			// input history product to get in ambil barang proccess
			foreach ($product as $key) {
				$data_product = array(
					'contract_history_id'	=> $history_id,
					'contract_id'			=> $contract_id,
					'product_id'			=> $key['product_id'],
					'product_request'		=> $key['product_qty'],
					'product_type'			=> '1', // 1 = product
					'created_by'			=> $this->session->userdata("admin_id"),
					'created_date'			=> date("Y-m-d H:i:s"),
				);
				$this->db->insert("contract_history_product", $data_product);
			}
			// echo "hello"; die();
			// to get product id it should repeat twice
			// get product id
			
			// print_r($date); die();
			date_default_timezone_set('Asia/Jakarta');
			$date1 = $get_schedule[0]['contract_date'];
	        $date2 = $get_schedule[0]['schedule_date'];
	        $ts1 = strtotime($date1);
	        $ts2 = strtotime($date2);
	        $year1 = date('Y', $ts1);
	        $year2 = date('Y', $ts2);
	        $month1 = date('m', $ts1);
	        $month2 = date('m', $ts2);
	        $date = (($year2 - $year1) * 12) + ($month2 - $month1);

			$qty_install = 0;
			$qty_service = 0;
			if(!empty($get_package)) {
				foreach ($get_package as $row) {
					$package = $this->global_model->get_data('*', 'product_package_detail', 'where package_id = "'.$row['package_id'].'" AND deleted = "0"')->result_array();

					// echo "dude"; die();
					// echo "<pre>"; print_r($get_schedule); die();
					if (!empty($package)) {
						if ($get_schedule[0]['schedule_type'] == 1) {
							foreach ($package as $value) {

								if ($get_schedule[0]['schedule_type'] == '1' ) { // install
									$req = $row['package_qty']*$value['total_per_install'];
								}elseif($get_schedule[0]['schedule_type'] == '2'){ // service
									$req = $row['package_qty']*$value['total_per_service'];
								}elseif ($get_schedule[0]['schedule_type'] == '3' ) { // termination
									$req = $row['package_qty']*$value['total_per_install'];
								}elseif ($get_schedule[0]['schedule_type'] == '4' ) { // complaint
									$req = $row['package_qty']*$value['total_per_install'];
								}elseif ($get_schedule[0]['schedule_type'] == '5' ) { //request
									$req = $row['package_qty']*$value['total_per_install'];
								}

						// die();

								$data_package['contract_history_id'] 	= $history_id;
								$data_package['contract_id']			= $contract_id;
								if ($get_schedule[0]['schedule_type'] == 2 && $value['service_period'] == $get_schedule[0]['month'] || $value['service_period'] == 1) {
									$data_package['product_id']			= $value['product_id'];
								}

								if ($get_schedule[0]['schedule_type'] == 1) {
									$data_package['product_id']			= $value['product_id'];
								}
								$data_package['product_request']		= $req;
								$data_package['product_type']			= '2';
								$data_package['created_by']				= $this->session->userdata("admin_id");
								$data_package['created_date']			= date('Y-m-d H:i:s');
										
								$this->db->insert("contract_history_product", $data_package);


							// echo "<pre>"; print_r($data_package); 
							}
							// die();
						}

						if ($get_schedule[0]['schedule_type'] == 2) {
								// do something
								foreach ($package as $key) {
									if ($key['service_period'] == $get_schedule[0]['month'] || $key['service_period'] == 1) {
										if ($get_schedule[0]['schedule_type'] == '1' ) { // install
											$req = $row['package_qty']*$key['total_per_install'];
										}elseif($get_schedule[0]['schedule_type'] == '2'){ // service
											$req = $row['package_qty']*$key['total_per_service'];
										}elseif ($get_schedule[0]['schedule_type'] == '3' ) { // termination
											$req = $row['package_qty']*$key['total_per_install'];
										}elseif ($get_schedule[0]['schedule_type'] == '4' ) { // complaint
											$req = $row['package_qty']*$key['total_per_install'];
										}elseif ($get_schedule[0]['schedule_type'] == '5' ) { //request
											$req = $row['package_qty']*$key['total_per_install'];
										}

								// die();

										$data_package['contract_history_id'] 	= $history_id;
										$data_package['contract_id']			= $contract_id;
										if ($get_schedule[0]['schedule_type'] == 2 && $key['service_period'] == $get_schedule[0]['month'] || $key['service_period'] == 1) {
											$data_package['product_id']			= $key['product_id'];
										}

										if ($get_schedule[0]['schedule_type'] == 1) {
											$data_package['product_id']			= $key['product_id'];
										}
										$data_package['product_request']		= $req;
										$data_package['product_type']			= '2';
										$data_package['created_by']				= $this->session->userdata("admin_id");
										$data_package['created_date']			= date('Y-m-d H:i:s');
												
										$this->db->insert("contract_history_product", $data_package);


									// echo "<pre>"; print_r($data_package); 
								}
							}
						}
					}
				}
				if ($get_schedule[0]['schedule_type'] == 2) {
					$total_req['total_product'] = $qty_request+$req;
					$this->db->where('contract_history_id', $history_id);
					$this->db->update('contract_history', $total_req);
				}
				// print_r($req); die();
			}
			// die();
			redirect("schedule_mrur");
			
		}else{
			redirect("schedule_mrur");
		}
		
	}
}