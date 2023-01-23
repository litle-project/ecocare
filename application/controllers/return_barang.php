<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Return_barang extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("return_barang_model");
		$this->load->model("global_model");
		$page=$this->uri->segment(2);
	}
	

	public function index()
	{
		priv("view");
		$schedule_type = array(4,3);
		$data["data"] 	= $this->return_barang_model->get_data($schedule_type);
		// echo "<pre>"; print_r($data['data']); die();
		$data["page"]	= "inventory/return_barang/view";
		$data["title"]	= "Manage Return Barang";
		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");
		$data['product']	= $this->return_barang_model->get_complaint_product($id);
		$data['package']	= $this->return_barang_model->get_complaint_package($id);
		if (!empty($data['package'])) {
			foreach ($data['package'] as $key) {
				$data['product_package'] = $this->global_model->get_data_join('*', 'product_package_detail a', 'where a.package_id = "'.$key['package_id'].'" AND a.deleted = "0"', 'left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id')->result_array();
			}
		}
		// echo "<pre>"; print_r($data['product_package']); die();
		$data['gudang']		= $this->global_model->get_data("*", "gudang", "where deleted = '0'")->result_array();
		$data['teknisi']	= $this->global_model->get_data_join("*", "contract_teknisi a", "where a.contract_schedule_id ='".$id."' and b.teknisi_type ='2'", "left join teknisi_master as b on b.teknisi_id = a.teknisi_id")->result_array();
		$data['data']		= $this->global_model->get_data_join("*", "contract_schedule a", "where a.contract_schedule_id = '".$id."'", "left join contract as b on b.contract_id = a.contract_id")->result_array();
		if ($data['data'][0]['schedule_type'] == '3') {
			$data["page"]		= "inventory/return_barang/detail_termination";
		}elseif($data['data'][0]['schedule_type'] == '4'){
			$data["page"]		= "inventory/return_barang/detail_complaint";
		}
		$data['branch']		= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		// echo "<pre>"; print_r($data); die();
		// $data["page"]		= "inventory/return_barang/detail";
		$data["title"]		= "Return Barang";
		$this->load->view('admin',$data);
	}

	function detail_package($contract_schedule_id)
	{
		$contract_id 			= $this->input->post('contract_id');
		$schedule_type 			= $this->input->post('schedule_type');
		$package_id 			= $this->input->post('package_id');
		
		// echo "<pre>"; print_r($this->input->post()); die();
		if ($schedule_type == '4') {
			$data['product_package'] = $this->global_model->get_data('*', 'contract_history a', 'where a.contract_schedule_id = "'.$contract_schedule_id.'" AND a.status = "1"')->result_array();
			if (!empty($data['product_package'])) {
				foreach ($data['product_package'] as $key) {
					$data['product'] = $this->global_model->get_data_join('*', 'contract_history_product a', 'where contract_history_id = "'.$key['contract_history_id'].'"', 'left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id')->result_array();
				}
			}
			// echo "string"; die();
		}else{
			// echo "string2"; die();
			$data['product']			= $this->global_model->get_data('*', 'contract_schedule_detail', 'where package_id = "'.$package_id.'" AND contract_schedule_id = "'.$contract_schedule_id.'"')->result_array();
			$data['schedule']			= $this->global_model->get_data('*', 'contract_schedule', 'where contract_schedule_id = "'.$contract_schedule_id.'"')->result_array();
			$data['package']			= $this->return_barang_model->data_package($package_id);
			$data['contract']			= $this->global_model->get_data('*', 'contract', 'where contract_id = "'.$contract_id.'"')->result_array();
		}

		$data['contract']		= $this->global_model->get_data('*', 'contract', 'where contract_id = "'.$contract_id.'"')->result_array();
		$data['data']			= $this->global_model->get_data('*', 'product_package', 'where package_id = "'.$package_id.'"')->result_array();
		$data['gudang']			= $this->global_model->get_data("*", "gudang", "where deleted = '0'")->result_array();
		$data['branch']			= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
			// echo "<pre>"; print_r($data['product']); die();
		if ($schedule_type == '3') {
			$data['page']			= "inventory/return_barang/detail_product_termination";
		}else{
			$data['page']			= "inventory/return_barang/detail_product_complaint";
		}
		// echo "<pre>"; print_r($data); die();
		$this->load->view('admin',$data);
	}

	function cek_gudang($id){
		
		$branch = $this->global_model->get_data("*", "branch", "where branch_id='".$id."' and deleted = '0'")->result_array();
		$gudang = $this->global_model->get_data("*", "gudang", "where branch_id='".$id."' AND deleted='0'")->result_array();
		if (!empty($branch)) {
			if (!empty($gudang)) {
					echo "<option value=''>---- Please Select ----</option>";
				foreach ($gudang as $key) {
					echo "<option value=".$key['gudang_id'].">".$key['gudang_name']."</option>";
				}
			}else{
				echo "<script>alert('Please Create Warehouse Before For This Branch!');</script>";
				echo '<option value="">---- Please Select -----</option>';
			}
		}else{
			echo "<script>alert('Please Select Branch');</script>";
		}
	}

	function validate_gudang_terminate($gudang_id='', $branch_id='', $product_id = ''){
		$cek = $this->global_model->get_data("*", "inventory_stock", "where gudang_id='".$gudang_id."' AND branch_id='".$branch_id."'")->result_array();
		// echo "<pre>"; print_r($product_aroma); die();
		if (!empty($cek)) {
			echo "<script>$('#product1".$product_id."').removeAttr('disabled','disabled');</script>";
		}else{
			echo "<script>alert('Please Create Gudang Before To Return This Product To Gudang That Has Selected');</script>";
			echo "<script>$('#product1".$product_id."').attr('disabled','disabled');</script>";
		}
	}

	function validate_gudang($gudang_id='', $branch_id='', $product_id = ''){
		$cek = $this->global_model->get_data("*", "inventory_stock", "where gudang_id='".$gudang_id."' AND branch_id='".$branch_id."'")->result_array();
		// echo "<pre>"; print_r($product_aroma); die();
		if (!empty($cek)) {
			echo "<script>$('#product".$product_id."').removeAttr('disabled','disabled');</script>";
		}else{
			echo "<script>alert('This warehouse is not in the branch that is in contract');</script>";
			echo "<script>$('#product".$product_id."').attr('disabled','disabled');</script>";
		}
	}

	function return_product($id="")
	{
		$post = $this->input->post();
		// echo "<pre>"; pirnt_r($post); die();
		
		$gudang_id				= $post['gudang_id'];
		$branch_id				= $post['branch_id'];
		$product_id 			= $post['product_id'];
		$contract_schedule_id 	= $post['contract_schedule_id'];

		if ($post['product_qty'] != 0 && !empty($post['product_qty'])) {

			$inventory_stock = $this->global_model->get_data("*", "inventory_stock", "where branch_id = '".$branch_id."' and gudang_id = '".$gudang_id."' and product_id = '".$product_id."'")->result_array();
				
				if (!empty($inventory_stock)) {
					// update data inventory stock
					$add_history['stock'] = $post['product_qty']+$inventory_stock[0]['stock'];
					$this->db->where("inventory_stock_id", $inventory_stock[0]['inventory_stock_id']);
					$this->db->update("inventory_stock", $add_history);
					
					// update data inventory
					$data_inv = $this->global_model->get_data('*', 'inventory', 'where inventory_id = "'.$inventory_stock[0]['inventory_id'].'"')->result_array();
					$inv['product_stock'] = $post['product_qty']+$data_inv[0]['product_stock'];
					$this->db->where("inventory_id", $data_inv[0]['inventory_id']);
					$this->db->update("inventory", $inv);
					
					// add data inventory log
					$inv_log = array(
						'product_id'		=> $product_id,
						'product_add_qty'	=> $post['product_qty'],
						'inventory_id'		=> $data_inv[0]['inventory_id'],
						'insert_from'		=> '3',
						'branch_id'			=> $branch_id,
						'gudang_id'			=> $gudang_id,
						'created_by'		=> $this->session->userdata('admin_id'),
						'created_date'		=> date('Y-m-d H:i:s'),
					);
					$this->db->insert('inventory_log', $inv_log);

					// update status schedule
					$schedule['return']	= '1';
					$this->db->where('contract_schedule_detail_id', $id);
					$this->db->update('contract_schedule_detail', $schedule);
					
					// add data log return
					if ($post['schedule_type'] == '4') {
						$log_return['return_from'] = '1';
					}elseif($post['schedule_type'] == '3'){
						$log_return['return_from'] = '2';
					}

					$log_return['product_id'] 					= $product_id;
					$log_return['product_qty']					= $post['product_qty'];
					$log_return['contract_schedule_id']			= $contract_schedule_id;
					$log_return['contract_schedule_detail_id']	= $id;
					$log_return['contract_id']					= $post['contract_id'];
					$log_return['created_date']					= date('Y-m-d H:i:s');
					$log_return['created_by']					= $this->session->userdata('admin_id');

					$this->db->insert('log_return', $log_return);

					// insert data log termination lost
					if (!empty($post['lost_qty']) || $post['lost_qty'] != 0) {
						$log_termination = array(
							'termination_date' 		=> $post['schedule_date'],
							'contract_id'			=> $post['contract_id'],
							'contract_schedule_id'	=> $contract_schedule_id,
							'lost_status'			=> '2',
							'lost_qty'				=> $post['lost_qty'],
							'product_id'			=> $product_id,
							'created_date'			=> date("Y-m-d H:i:s"),
							'created_by'			=> $this->session->userdata('admin_id'),
						);

						$this->db->insert('log_termination', $log_termination);
					}

					redirect('return_barang/detail/'.$contract_schedule_id.'');

				}else{

					// echo "<pre>"; print_r($post); die();
					// insert inventory where inv gudang not found in table inventory
					$include['product_id']		= $post['product_id'];
					$include['branch_id']		= $post['branch_id'];
					$include['gudang_id']		= $post['gudang_id'];
					$include['product_stock']	= $post['product_qty'];
					$include['created_by']		= $this->session->userdata('admin_id');
					$include['created_date']	= date("Y-m-d H:i:s");
					$this->db->insert('inventory', $include);
					$id_inv = $this->db->insert_id();

					// inventory log
					$inv_log2 = array(
						'product_id'		=> $post['product_id'],
						'product_add_qty'	=> $post['product_qty'],
						'inventory_id'		=> $id_inv,
						'insert_from'		=> '3',
						'branch_id'			=> $post['branch_id'],
						'gudang_id'			=> $post['gudang_id'],
						'created_by'		=> $this->session->userdata('admin_id'),
						'created_date'		=> date('Y-m-d H:i:s'),
					);
					$this->db->insert('inventory_log', $inv_log2);

					// update status schedule
					$schedule['return']	= '1';
					$this->db->where('contract_schedule_detail_id', $id);
					$this->db->update('contract_schedule_detail', $schedule);
					
					// add data log return
					if ($post['schedule_type'] == '4') {
						$log_return['return_from'] = '1';
					}elseif($post['schedule_type'] == '3'){
						$log_return['return_from'] = '2';
					}

					$log_return['product_id'] 					= $post['product_id'];
					$log_return['product_qty']					= $post['product_qty'];
					$log_return['contract_schedule_id']			= $contract_schedule_id;
					$log_return['contract_schedule_detail_id']	= $id;
					$log_return['contract_id']					= $post['contract_id'];
					$log_return['created_date']					= date('Y-m-d H:i:s');
					$log_return['created_by']					= $this->session->userdata('admin_id');

					$this->db->insert('log_return', $log_return);

					// insert data log termination lost
					if (!empty($post['lost_qty']) || $post['lost_qty'] != 0) {
						$log_termination = array(
							'termination_date' 		=> $post['schedule_date'],
							'contract_id'			=> $post['contract_id'],
							'contract_schedule_id'	=> $contract_schedule_id,
							'lost_status'			=> '2',
							'lost_qty'				=> $post['lost_qty'],
							'product_id'			=> $post['product_id'],
							'created_date'			=> date("Y-m-d H:i:s"),
							'created_by'			=> $this->session->userdata('admin_id'),
						);

						$this->db->insert('log_termination', $log_termination);
					}

					redirect('return_barang/detail/'.$contract_schedule_id.'');
				}
		}else{

			// insert data log termination lost
			if (!empty($post['lost_qty']) && $post['lost_qty'] != 0) {
				$log_termination = array(
					'termination_date' 		=> $post['schedule_date'],
					'contract_id'			=> $post['contract_id'],
					'contract_schedule_id'	=> $contract_schedule_id,
					'lost_status'			=> '2',
					'lost_qty'				=> $post['lost_qty'],
					'product_id'			=> $product_id,
					'created_date'			=> date("Y-m-d H:i:s"),
					'created_by'			=> $this->session->userdata('admin_id'),
				);

				// $this->db->insert('log_termination', $log_termination);

				// update status schedule
				$schedule['return']	= '1';
				$this->db->where('contract_schedule_detail_id', $id);
				$this->db->update('contract_schedule_detail', $schedule);
			}

			redirect('return_barang/detail/'.$contract_schedule_id.'');
		}
	}

	public function return_product_package($contract_schedule_id='')
	{
		$post = $this->input->post();
		$gudang_id				= $post['gudang_id'];
		$branch_id				= $post['branch_id'];
		$product_id 			= $post['product_id'];

		$inventory_stock = $this->global_model->get_data("*", "inventory_stock", "where branch_id = '".$branch_id."' and gudang_id = '".$gudang_id."' and product_id = '".$product_id."'")->result_array();
		
		// echo "<pre>"; print_r($inventory_stock); die();
			if (!empty($inventory_stock)) {
				// update data inventory stock
				$add_history['stock'] = $post['product_qty']+$inventory_stock[0]['stock'];
				$this->db->where("inventory_stock_id", $inventory_stock[0]['inventory_stock_id']);
				$this->db->update("inventory_stock", $add_history);

				// update stock inv master
				$data_inv = $this->global_model->get_data('*', 'inventory', 'where inventory_id = "'.$inventory_stock[0]['inventory_id'].'"')->result_array();
				$inv['product_stock'] = $post['product_qty']+$data_inv[0]['product_stock'];
				$this->db->where("inventory_id", $data_inv[0]['inventory_id']);
				$this->db->update("inventory", $inv);

				//  log return package
				$log_return['product_id'] 					= $product_id;
				$log_return['product_qty']					= $post['product_qty'];
				$log_return['contract_schedule_id']			= $contract_schedule_id;
				$log_return['contract_id']					= $post['contract_id'];
				$log_return['created_date']					= date('Y-m-d H:i:s');
				$log_return['created_by']					= $this->session->userdata('admin_id');

				$this->db->insert('log_return_package', $log_return);

				// add data inventory log
				$inv_log = array(
					'product_id'		=> $product_id,
					'product_add_qty'	=> $post['product_qty'],
					'inventory_id'		=> $data_inv[0]['inventory_id'],
					'insert_from'		=> '3',
					'branch_id'			=> $branch_id,
					'gudang_id'			=> $gudang_id,
					'created_by'		=> $this->session->userdata('admin_id'),
					'created_date'		=> date('Y-m-d H:i:s'),
				);
				$this->db->insert('inventory_log', $inv_log);

				redirect('return_barang/detail/'.$contract_schedule_id.'');
			}else{
				redirect('return_barang/detail/'.$contract_schedule_id.'');
		}

	}

	public function print_rts($id='')
	{
		priv("view");
        
        $pdf = $this->input->post('pdf');

        $data["print"] 		= FALSE;
		$data['data']		= $this->return_barang_model->get_data_rts($id);
		$data["rts_number"] = $this->global_model->get_data("*, MAX(rts_number) as last_id","log_return","order by rts_number DESC")->result_array();
		// echo "<pre>"; print_r($data['data']); die();
		$data["page"]		= "inventory/return_barang/print/print_rts";
		$data["title"]		= "Laporan RTS";
		$this->load->view('admin',$data);

		if (($pdf)) {
    		if ($this->input->post()) {
    		// print_r($id); die();
	        	$post = $this->input->post(); 
	    		$contract_schedule_id = $post['contract_schedule_id'];

	        	$log_rts['rts_number'] = $post['rts_number'];
	    		$this->db->where('return_id', $id);
	    		$this->db->update('log_return', $log_rts);

	            $data["print"] 		= TRUE;
				$data['data']		= $this->return_barang_model->get_data_rts($contract_schedule_id);
	            // echo "<pre>"; print_r($data['data']); die();
	            $this->_to_pdf($data);
    		
	    	}
        }
	}

	function _to_pdf($all_data = array()) {
        $this->load->library('pdf_exporter', '', 'pdf');
        $view = $this->load->view('admin/'.$all_data["page"], $all_data, TRUE);
        $this->pdf->output_pdf($view, $all_data["title"] . '.pdf');
    }
}