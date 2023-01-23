<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ambil_barang extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("ambil_barang_model");
		$this->load->model("global_model");
		$page=$this->uri->segment(2);
	}
	

	public function index()
	{
		priv("view");
		$data["data"] 	= $this->ambil_barang_model->get_data_view();
		$data["page"]	= "inventory/ambil_barang/view";
		$data["title"]	= "Ambil Barang";
		$this->load->view('admin',$data);
	}

	public function detail($history_id)
	{
		priv("view");
		$data['data']	= $this->ambil_barang_model->get_product_detail($history_id);
		// echo "<pre>"; print_r($data['data']); die();
		$data["page"]	= "inventory/ambil_barang/detail";
		$data["title"]	= "Detail Product & Aroma";
		$this->load->view('admin',$data);
	}

	public function detail_aroma($id)
	{
		priv("view");
		$data['data']	= $this->global_model->get_data_join("*", "contract_history_aroma a", "where a.history_aroma_id ='".$id."'", "left join product_aroma as b on b.product_aroma_id = a.product_aroma_id left join gudang as c on c.gudang_id = a.gudang_id")->result_array();
		// print_r($data['data']); die();
		$data["page"]	= "inventory/ambil_barang/aroma/detail";
		$data["title"]	= "Detail Product & Aroma";
		$this->load->view('admin',$data);
	}

	function edit(){
		$contract_id 			= $this->input->get("contract_id");
		$contract_history_id 	= $this->input->get("contract_history_id");
		
		$data["data"]			= $this->ambil_barang_model->get_data($contract_id, $contract_history_id);
		$data["branch"] 		= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		$data["gudang"] 		= $this->global_model->get_data("*", "gudang", "where deleted = '0'")->result_array();
		$data["teknisi"] 		= $this->global_model->get_data("*", "teknisi_master", "where deleted = '0' and teknisi_type = '2'")->result_array();
		$data['product'] 		= $this->ambil_barang_model->get_product($contract_history_id);
		// echo "<pre>"; print_r($data['product']); die();
		$data["page"]			= "inventory/ambil_barang/edit";
		$data["title"]			= "Edit Ambil Barang";
		$this->load->view('admin',$data);

		if($this->input->post()){
			$post = $this->input->post();

			// echo "<pre>"; print_r($post); die();
			if (!empty($post['product_taked']) || $post['product_taked'] != 0) {
				$total = '';
				for ($i=0; $i<count($post['product_taked']); $i++) { 
					$total += $post['product_taked'][$i];
					
					// update contract history product
						$history_product = array(
							'product_taked'		=> $post['product_taked'][$i],
							'gudang_id'			=> $post['gudang_id'][$i],
						);
						$this->db->where("history_product_id", $post['history_product_id'][$i]);
						$this->db->update("contract_history_product", $history_product);

					// update inventory
						$inv = $this->global_model->get_data("*", "inventory", "where product_id='".$post['product'][$i]."' AND branch_id = '".$post['branch_id']."' AND gudang_id ='".$post['gudang_id'][$i]."'")->result_array();
						
						$inventory['product_stock'] = $inv[0]['product_stock']-$post['product_taked'][$i];

						$this->db->where('inventory_id', $inv[0]['inventory_id']);
						$this->db->update('inventory', $inventory);

					// update inventory stock
						$inv_stock = $this->global_model->get_data("*", "inventory_stock", "where inventory_id = '".$inv[0]['inventory_id']."'")->result_array();
						$stock['stock'] = $inv_stock[0]['stock']-$post['product_taked'][$i];

						$this->db->where('inventory_stock_id', $inv_stock[0]['inventory_stock_id']);
						$this->db->update('inventory_stock', $stock);
						
				}


			// update contract history
				$data_contract = $this->global_model->get_data("*", "contract_history", "where contract_history_id = '".$contract_history_id."'")->result_array();
				
				$input_contract['product_taked'] = $data_contract[0]['product_taked']+$total;
				// {
					$this->db->where("contract_history_id", $contract_history_id);
					$this->db->update("contract_history", $input_contract);
				// }

				$cek = $this->global_model->get_data("*", "contract_history", "where contract_history_id = '".$contract_history_id."'")->result_array();
				// echo  "<pre>"; print_r($cek); die();
				if ($cek[0]['product_taked'] == $cek[0]['total_product']) {
					$status['status'] = '1';
					// {
						$this->db->where("contract_history_id", $contract_history_id);
						$this->db->update("contract_history", $status);
					// }
				}
				redirect('ambil_barang');
			}else{
				redirect('ambil_barang/edit?contract_history_id='.$contract_history_id.'&contract_id='.$contract_id.'');
			}
		}
	}

	function aroma($id=''){
		$data["data"] 	= $this->global_model->get_data_join("*", "contract_history_product a", "where a.history_product_id='".$id."'", "left join product_master as b on b.product_id = a.product_id")->result_array();
		// echo "<pre>"; print_r($data['data']); die();
		$data['gudang']	= $this->global_model->get_data("*", "gudang", "where deleted = '0'")->result_array();
		$data["page"]		="inventory/ambil_barang/aroma/view";
		$data["title"]		="Take Aroma";

		$this->load->view('admin',$data);
		
		if ($this->input->post()) {
			$post = $this->input->post();
			
			$total = '';
			for ($i=0; $i<count($post['product_aroma']); $i++) { 
			 
				$aroma_history = array(
					'product_aroma_id'		=> $post['product_aroma'][$i],
					'contract_history_id'	=> $post['contract_history_id'],
					'contract_id'			=> $post['contract_id'],
					'product_id'			=> $post['product_id'],
					'gudang_id'				=> $post['gudang_id'],
					'aroma_taked'			=> $post['product_aroma_qty'][$i],
					'created_date'			=> date("Y-m-d H:i:s"),
					'created_by'			=> $this->session->userdata("admin_id"),
				);
				$this->db->insert("contract_history_aroma", $aroma_history);
				
				// udpate inventory stock
				$aroma_inv = $this->global_model->get_data("*", "inventory_stock", "where product_aroma_id = '".$post['product_aroma'][$i]."' and gudang_id = '".$post['gudang_id']."'")->result_array();
				
				$update['stock'] = $aroma_inv[0]['stock']-$post['product_aroma_qty'][$i];
				// {
					$this->db->where("gudang_id", $post['gudang_id']);
					$this->db->where("product_aroma_id", $post['product_aroma'][$i]);
					$this->db->update("inventory_stock", $update);
				// }


				// update inventory
				$inv = $this->global_model->get_data("*", "inventory", "where inventory_id = '".$aroma_inv[0]['inventory_id']."'")->result_array();
				
				$total += $post['product_aroma_qty'][$i];
				$update_inv['product_stock'] = $inv[0]['product_stock']-$total;
				// {
					$this->db->where("inventory_id", $aroma_inv[0]['inventory_id']);
					$this->db->update("inventory", $update_inv);
				// }


				// update contract history product
				$update_history['product_taked'] 	= $total;
				$update_history['gudang_id'] 		= $post['gudang_id'];
				// {
					$this->db->where('history_product_id', $post['history_product_id']);
					$this->db->update("contract_history_product", $update_history);
				// }


				// update contract history
				$history_contract['product_taked'] = $total;
				// {
					$this->db->where('contract_history_id', $post['contract_history_id']);
					$this->db->update("contract_history", $history_contract);
				// }
			}
			// echo "<pre>"; print_r($update_history); die();
			redirect('ambil_barang/edit?contract_history_id='.$post['contract_history_id'].'&contract_id='.$post['contract_id'].'');
		}
	}

	function validate_inventory($gudang_id='', $product_id='', $input=''){
		$aroma = $this->global_model->get_data_join("*", "inventory_stock a", "where a.gudang_id='".$gudang_id."' AND a.product_id='".$product_id."'", "left join product_aroma as b on b.product_id = a.product_id")->result_array();
		// echo "<pre>"; print_r($product_aroma); die();
		if (!empty($aroma)) {
			echo "<center><span style='color: #40e437;'><i class='fa fa-check'></i></span></center>";
			echo "<script>$('#product_".$input."').removeAttr('disabled','disabled');</script>";
		}else{
			echo "<script>alert('This Product Not Available In This Gudang or Create Inventory For This Product!');</script>";
			echo "<center><span style='color: #ff4747;'><i class='fa fa-times' aria-hidden='true'></i></span></center>";
			echo "<script>$('#product_".$input."').attr('disabled','disabled');</script>";
		}
	}

	function validate_gudang($gudang_id='', $product_id=''){
		$aroma = $this->global_model->get_data_join("*", "inventory_stock a", "where a.gudang_id='".$gudang_id."' AND a.product_id='".$product_id."'", "left join product_aroma as b on b.product_id = a.product_id")->result_array();
		// echo "<pre>"; print_r($product_aroma); die();
		if (!empty($aroma)) {
			// echo "<script>alert('Your Aroma Available In This Gudang');</script>";
		}else{
			echo "<script>alert('Your Aroma Not Available In This Gudang');</script>";
			echo "<span style='color: #ff4747;'>Please Create Aroma In This Gudang Before!</span>";
		}
	}

	function cek_aroma($gudang_id='', $product_id=''){
		
		$aroma = $this->global_model->get_data_join("*", "inventory_stock a", "where a.gudang_id='".$gudang_id."' AND a.product_id='".$product_id."' AND a.deleted = '0'", "left join product_aroma as b on b.product_aroma_id = a.product_aroma_id")->result_array();
        $output = ' <script>aroma_num_rows='.count($aroma).'</script>
        			<table class="table table-striped table-bordered table-hover display" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>No</th>
							<th>Check</th>
							<th>Product Aroma</th>
							<th>Stock Available</th>
							<th>Product Quantity</th>
                        </tr>
                    </thead>
                    <tbody> 
                    ';
                                
        $no=1;
        for($i=0; $i<count($aroma); $i++){
        	if (!empty($aroma[$i]['product_aroma_id'])) {
		        $output .= '<tr>
			                    <td>'.$no.'</td>
								<td><input type="checkbox" class="checkbox" name="product_aroma[]" value='.$aroma[$i]["product_aroma_id"].' onchange="input_qty(this)">
								</td>
								<td>'.$aroma[$i]["product_aroma_name"].'</td>
								<td>'.$aroma[$i]["stock"].'</td>
								<td><input type="text" class="form-control" name="product_aroma_qty[]" id="product_aroma_qty'.$aroma[$i]["product_aroma_id"].'" disabled onkeyup="sum_aroma_qty(this, this.value)">
							</tr>'.$no++;
	        }else{
	        	$output .= '<tr>
			                    <td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>'.$no++;
	        }
    	}
	        $output .= '</tbody></table>';

        echo $output;

	}
}