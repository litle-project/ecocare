<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventory_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("inventory_model");
		$page=$this->uri->segment(2);
	}
	
	public function index()
	{
		priv('view');
		$data["data"] 	= $this->inventory_model->get_data();
		$data["page"]	= "inventory/master/view";
		$data["title"]	= "Manage Inventory";

		$this->load->view('admin',$data);
	}

	public function detail()
	{
		priv('view');
		$inventory_id 	= $this->input->get("inventory_id");
		$branch_id		= $this->input->get("branch_id");
		$gudang_id		= $this->input->get("gudang_id");
		$product_id 	= $this->input->get("product_id");
		$data['data'] 	= $this->inventory_model->get_data_detail($inventory_id, $branch_id, $gudang_id, $product_id);
		$data["page"]	= "inventory/master/detail";
		$data["title"]	= "Stock Aroma";

		$this->load->view('admin',$data);
	}

	public function add()
	{
		priv('add');
		$data["page"]		="inventory/master/add";
		$data["title"]		="Add New Inventory";
		$data["product"] 	= $this->global_model->get_data("*", "product_master", "where deleted = '0'")->result_array();
		$data["branch"] 	= $this->global_model->get_data("*", "branch", "where deleted = '0'")->result_array();
		$this->load->view('admin',$data);

		if($this->input->post()){
			$post=$this->input->post();
			// print_r($post); die();
			$check = $this->global_model->get_data("*","inventory"," where deleted='0' AND branch_id='".$post["branch_id"]."' AND gudang_id='".$post["gudang_id"]."' AND product_id='".$post["product_id"]."'")->result_array();

			if(empty($check)){
				// input new inventory
				$input=array(
					"product_id" 	=> $post["product_id"],
					"branch_id" 	=> $post["branch_id"],
					"gudang_id" 	=> $post["gudang_id"],
					"product_stock" => $post["product_stock"],
					"min_stock" 	=> $post["min_stock"],
					"created_date"  => date("Y-m-d H:i:s"),
					"created_by" 	=> $this->session->userdata("admin_id"),
				);
						
				$this->global_model->save_data($input,"inventory");
				$id = $this->db->insert_id();

				// input log
				$log['inventory_id'] 	= $id;
				$log['insert_from']		= '1'; // 1 = inv, 2 = tbh brg, 3 = return brang 
				$log['product_id']		= $post['product_id'];
				$log['product_add_qty']	= $post['product_stock'];
				$log['branch_id']		= $post['branch_id'];
				$log['gudang_id']		= $post['gudang_id'];
				$log['created_by']		= $this->session->userdata('admin_id');
				$log['created_date']	= date("Y-m-d H:i:s");
				$log['status']			= '1';
				$this->db->insert("inventory_log", $log);

				// input stock
				$product_aroma = $this->input->get_post("product_aroma");
				if(count($product_aroma) > 0 && !empty($product_aroma)){
		             for($i=0;$i<count($product_aroma);$i++){
		             	$inv[$i]["inventory_id"] 		= $id;
		             	$inv[$i]['gudang_id'] 			= $post['gudang_id'];
		             	$inv[$i]['branch_id'] 			= $post['branch_id'];
		             	$inv[$i]["product_id"] 			= $post["product_id"];
		                $inv[$i]["product_aroma_id"] 	= $product_aroma[$i];
		                $inv[$i]["stock"] 				= $this->input->get_post("product_aroma_qty".$product_aroma[$i]);
		                $inv[$i]["update_date"] 		= date("Y-m-d H:i:s");
		                $inv[$i]["update_by"] 			= $this->session->userdata("admin_id");

		                $this->db->insert("inventory_stock", $inv[$i]);
						$id_stock = $this->db->insert_id();
		            }
		        }else{
		        	$inv["inventory_id"] 		= $id;
	             	$inv['gudang_id'] 			= $post['gudang_id'];
	             	$inv['branch_id'] 			= $post['branch_id'];
	             	$inv["product_id"] 			= $post["product_id"];
	                $inv["product_aroma_id"] 	= "";
	                $inv["stock"] 				= $post['product_stock'];
	                $inv["update_date"] 		= date("Y-m-d H:i:s");
	                $inv["update_by"] 			= $this->session->userdata("admin_id");
	                $this->db->insert("inventory_stock", $inv);
					$id_stock = $this->db->insert_id();
					

		        }

				$action="Create Inventory ".$post["product_id"];
				$this->Aktiviti_log_model->create($action);
				
				redirect("inventory_master");

			}else{ //update process
				
				// update inventory
				$input=array(
					"product_id" 	=> $post["product_id"],
					"branch_id" 	=> $post["branch_id"],
					"gudang_id" 	=> $post["gudang_id"],
					"product_stock" => $post["product_stock"]+$check[0]['product_stock'],
					"min_stock" 	=> $post["min_stock"],
					"update_by"  => date("Y-m-d H:i:s"),
					"update_date" 	=> $this->session->userdata("admin_id"),
				);
				$this->db->where("inventory_id", $check[0]['inventory_id']);
				$this->db->update("inventory", $input);
				
				// input log
				$log['inventory_id'] 	= $check[0]['inventory_id'];
				$log['insert_from']		= '1'; // 1 = inv, 2 = tbh brg, 3 = return brang 
				$log['product_id']		= $post['product_id'];
				$log['product_add_qty']	= $post['product_stock'];
				$log['branch_id']		= $post['branch_id'];
				$log['gudang_id']		= $post['gudang_id'];
				$log['created_by']		= $this->session->userdata('admin_id');
				$log['created_date']	= date("Y-m-d H:i:s");
				$log['status']			= '1';
				$this->db->insert("inventory_log", $log);

				// update stock
				$product_aroma = $this->input->get_post("product_aroma");
				if(count($product_aroma) > 0 && !empty($product_aroma)){
		            for($i=0;$i<count($product_aroma);$i++){
					
					$get_stock = $this->input->get_post("product_aroma_qty".$product_aroma[$i]);
					$aroma_available = $this->global_model->get_data("*", "inventory_stock", "where inventory_id='".$check[0]['inventory_id']."' and product_id = '".$check[0]['product_id']."' and branch_id='".$check[0]['branch_id']."' and gudang_id = '".$check[0]['gudang_id']."' and product_aroma_id = '".$product_aroma[$i]."'")->result_array();
					// print_r($aroma_available); die();
		            	if (!empty($aroma_available)) {
		            		// echo "satu"; die();
			             	$inv[$i]["inventory_id"] 		= $aroma_available[0]['inventory_id'];
			             	$inv[$i]['gudang_id'] 			= $post['gudang_id'];
			             	$inv[$i]['branch_id'] 			= $post['branch_id'];
			             	$inv[$i]["product_id"] 			= $post["product_id"];
			                $inv[$i]["product_aroma_id"] 	= $product_aroma[$i];
			                $inv[$i]["stock"] 				= $get_stock+$aroma_available[0]['stock'];
			                $inv[$i]["update_date"] 		= date("Y-m-d H:i:s");
			                $inv[$i]["update_by"] 			= $this->session->userdata("admin_id");
		                	
		                	$this->db->where("inventory_stock_id", $aroma_available[0]['inventory_stock_id']);
		                	$this->db->update("inventory_stock", $inv[$i]);

		            	}else{
		            		// echo "dua"; die();
		            		$inv[$i]["inventory_id"] 		= $check[0]['inventory_id'];
			             	$inv[$i]['gudang_id'] 			= $post['gudang_id'];
			             	$inv[$i]['branch_id'] 			= $post['branch_id'];
			             	$inv[$i]["product_id"] 			= $post["product_id"];
			                $inv[$i]["product_aroma_id"] 	= $product_aroma[$i];
			                $inv[$i]["stock"] 				= $this->input->get_post("product_aroma_qty".$product_aroma[$i]);
			                $inv[$i]["update_date"] 		= date("Y-m-d H:i:s");
			                $inv[$i]["update_by"] 			= $this->session->userdata("admin_id");
		                	$this->db->insert("inventory_stock", $inv[$i]);
							$id_stock = $this->db->insert_id();

		                	
		            	}
		            }
		        }else{

					$aroma_available = $this->global_model->get_data("*", "inventory_stock", "where inventory_id='".$check[0]['inventory_id']."' and product_id = '".$check[0]['product_id']."' and branch_id='".$check[0]['branch_id']."' and gudang_id = '".$check[0]['gudang_id']."'")->result_array();
					
					if (!empty($aroma_available)) {
			        	$inv["inventory_id"] 		= $aroma_available[0]['inventory_id'];
		             	$inv['gudang_id'] 			= $post['gudang_id'];
		             	$inv['branch_id'] 			= $post['branch_id'];
		             	$inv["product_id"] 			= $post["product_id"];
		                $inv["product_aroma_id"] 	= "";
		                $inv["stock"] 				= $post['product_stock']+$aroma_available[0]['stock'];
		                $inv["update_date"] 		= date("Y-m-d H:i:s");
		                $inv["update_by"] 			= $this->session->userdata("admin_id");
		                
		                $this->db->where("inventory_stock_id", $aroma_available[0]['inventory_stock_id']);
		                $this->db->update("inventory_stock", $inv);


					}else{
						$inv["inventory_id"] 		= $check[0]['inventory_id'];
		             	$inv['gudang_id'] 			= $post['gudang_id'];
		             	$inv['branch_id'] 			= $post['branch_id'];
		             	$inv["product_id"] 			= $post["product_id"];
		                $inv["product_aroma_id"] 	= "";
		                $inv["stock"] 				= $post['product_stock'];
		                $inv["update_date"] 		= date("Y-m-d H:i:s");
		                $inv["update_by"] 			= $this->session->userdata("admin_id");
		                $this->db->insert("inventory_stock", $inv);
		                $id_stock = $this->db->insert_id();

					}
		        }

		        redirect('inventory_master');
			}
		}
	}

	function delete($id){
		priv('delete');
		$this->global_model->delete_data($id, 'inventory_id', 'inventory');
		$this->global_model->delete_data($id, 'inventory_id', 'inventory_stock');
		
		// update status at log inv
		$input['status'] = '0';
		$this->db->where("inventory_id", $id);
		$this->db->update("inventory_log", $input);

		redirect("inventory_master");
	}

	function cek_gudang($id){
		
		$branch = $this->global_model->get_data("*", "branch", "where branch_id='".$id."' and deleted = '0'")->result_array();
		$gudang = $this->global_model->get_data("*", "gudang", "where branch_id='".$id."' AND deleted='0'")->result_array();
		if (!empty($branch)) {
			if (!empty($gudang)) {
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

	function validate_aroma($id){
		$product = $this->global_model->get_data("*", "product_master", "where product_id='".$id."' and deleted = '0'")->result_array();
		$aroma 	 = $this->global_model->get_data("*", "product_aroma", "where product_id='".$id."' AND deleted='0'")->result_array();

		if (!empty($product)) {
			if ($product[0]['aroma'] == 1 && $product[0]['category_id'] == 2) {
				if (!empty($aroma)) {
					echo '<input type="number" class="form-control" min="1" placeholder="Stock" name="product_stock" id="stock" required/>';
				}else{
					echo "<script>alert('Please Create Product Aroma Before for This Product');</script>";
					echo '<input type="number" readonly class="form-control" min="1" placeholder="Stock" name="product_stock" id="stock" required/>';
				}
			}else{
				echo '<input type="number" class="form-control" min="1" placeholder="Stock" name="product_stock" id="stock" required/>';
			}
		}else{
			echo "<script>alert('Product Unknown');</script>";
		}
	}


	function cek_aroma($id){
		
		$product_aroma = $this->global_model->get_data("*", "product_aroma", "where product_id='".$id."' AND deleted='0'")->result_array();
        $output = ' <script>aroma_num_rows='.count($product_aroma).'</script>
        			<table class="table table-striped table-bordered table-hover display" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>No</th>
							<th>Check</th>
							<th>Product Aroma</th>
							<th>Product Quantity</th>
                        </tr>
                    </thead>
                    <tbody> 
                    ';
                                
        $no=1;
        for($i=0; $i<count($product_aroma); $i++){
        $output .= '<tr>
                    <td>'.$no.'</td>
                    <td><input type="checkbox" name="product_aroma[]" value='.$product_aroma[$i]["product_aroma_id"].' onchange="input_qty(this)"></td>
                    <td>'.$product_aroma[$i]["product_aroma_name"].'</td>
					<td>'.form_input("product_aroma_qty".$product_aroma[$i]["product_aroma_id"],"","class='form-control' id='product_aroma_qty".$product_aroma[$i]["product_aroma_id"]."' disabled onkeyup='sum_aroma_qty(this,this.value)' ").'</td>';
                    $no++;
        }
        $output .= '</tbody></table>';

        echo $output;

	}
}