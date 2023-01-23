<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contract_complaint extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("contract_complaint_model");	
		$this->load->model("global_model");
		$page=$this->uri->segment(2);
	}
	
	public function index()
	{
		priv("view");
		$data["data"]	= $this->contract_complaint_model->get_data();
		// echo "<pre>"; print_r($data['data']); die();
		$data["page"]	= "contract/complaint/view";
		$data["title"]	= "Manage Contract Complaint";
		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");
		$data['data'] 		= $this->contract_complaint_model->get_data($id);
		$data['teknisi'] 	= $this->global_model->get_data_join("*", "contract_teknisi a", "where a.contract_schedule_id = '".$id."' and b.teknisi_type = '2'", "left join teknisi_master as b on b.teknisi_id = a.teknisi_id")->result_array();
		$data["product"]	= $this->contract_complaint_model->product_detail($id);
		// echo "<pre>"; print_r($data['product']); die();
		$data["page"]		= "contract/complaint/detail";
		$data["title"]		= "Detail Complaint";
		$this->load->view('admin',$data);
	}

	public function add()
	{
		priv("add");
		$data["page"]		= "contract/complaint/add";
		$data["title"]		= "Add New Complaint";
		$data["contract"]	= $this->global_model->get_data_join("*", "contract a", "where a.deleted='0' and a.terminate='0' and a.assign_status = '1' and b.status = '1' group by b.contract_id", "left join contract_history as b on b.contract_id = a.contract_id")->result_array();
		if($this->input->post()) {
			$contract_id = $this->input->post("contract_id");
			redirect("contract_complaint/add_detail/".$contract_id);
		}
		$this->load->view('admin',$data);
	}

	function add_detail($id){
		priv("edit");
		$data['data'] 		= $this->global_model->get_data("*", "contract", "where contract_id = '".$id."'")->result_array();
		$data['product']	= $this->contract_complaint_model->get_product($id);
		$data['package']	= $this->contract_complaint_model->get_package($id);
		$data['teknisi']	= $this->global_model->get_data("*", "teknisi_master", "where teknisi_type = '2' AND deleted = '0'")->result_array();
		$data["page"]	= "contract/complaint/add_detail";
		$data["title"]	= "Add Detail Complaint";
		$this->load->view('admin',$data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();

            // insert schedule install
			$date   = date("Y-m-d", strtotime($post['complaint_date']));
	        $schedule_install = array(
	            "contract_id" 		=> $id,
	            "schedule_date" 	=> $date,
	            "created_date" 		=> date("Y-m-d H:i:s"),
	            "schedule_type" 	=> "4",
	            "reason"			=> $post['reason_complaint'],
	            "note"				=> $post['complaint_note']
	            );
	        $this->db->insert("contract_schedule", $schedule_install);
	        $schedule_id = $this->db->insert_id();
			// echo "<pre>"; print_r($schedule_install); die();

	        // insert schedule teknisi
	        for ($i=0; $i<count($post['teknisi']); $i++) { 
	            $schedule_teknisi['contract_schedule_id']   = $schedule_id;
	            $schedule_teknisi['contract_id']    		= $id;
	            $schedule_teknisi['teknisi_id']     		= $post['teknisi'][$i];
	            $schedule_teknisi['created_date']   		= date("Y-m-d H:i:s");
	            $schedule_teknisi['created_by']     		= $this->session->userdata("admin_id");

	            $this->db->insert("contract_teknisi", $schedule_teknisi);
	        }

			$product = $this->input->get_post("product_id");
			if(count($product) > 0 && !empty($product)){
	            for($i=0;$i<count($product);$i++){
	             	
	             	$get_price = $this->global_model->get_data("*", "contract_detail", "where contract_detail_id = '".$post['contract_detail_id'][$i]."'")->result_array();
						
                    $schedule_detail = array(
                        "contract_schedule_id"      => $schedule_id,
                        "product_type"              => '2',
                        "package_id"                => '0',
                        "product_id"                => $product[$i],
                        "product_qty"               => $post['product_package_qty'.$product[$i].""],
                        "package_qty"               => '0',
                    );
					// echo "<pre>"; print_r($schedule_detail); die();
                    $this->db->insert("contract_schedule_detail", $schedule_detail);
             	}
            }

            $package = $this->input->get_post("package_id");
            if (count($package) > 0 && !empty($package)) {
            	for ($i=0; $i<count($package) ; $i++) { 
            		$schedule_package = array(
            			'contract_schedule_id' 	=> $schedule_id,
            			'product_type'			=> '1',
            			'package_id'			=> $package[$i],
            			'product_id'			=> '0',
            			'package_qty'			=> $post['package_qty'.$package[$i].""],
            			'product_qty'			=> '0',
            			'price'					=> $post['package_price'][$i]
            		);
            		$this->db->insert("contract_schedule_detail", $schedule_package);
            	}
            }

            $update_schedule['parent_schedule_id'] = $schedule_id;
            $this->db->where('contract_schedule_id', $schedule_id);
            $this->db->update('contract_schedule', $update_schedule);

			// input log
			$action="Add New Complaint ".$post["contract_name"];
			$this->Aktiviti_log_model->create($action);			
		
			redirect("contract_complaint");
		}

	}

	public function edit($id)
	{
		priv("edit");
		$data["page"]				= "contract/complaint/edit";
		$data["title"]				= "Edit Complaint";
		$data["product"]			= $this->contract_complaint_model->get_product_detail($id);
		$data["package"]			= $this->contract_complaint_model->get_package_detail($id);
		$data["oprator"] 			= $this->global_model->get_data_join("*", "contract_teknisi a", "where a.contract_schedule_id = '".$id."' and b.teknisi_type = '2'", "left join teknisi_master as b on b.teknisi_id = a.teknisi_id")->result_array();
		$data['teknisi']			= $this->global_model->get_data("*", "teknisi_master", "where teknisi_type = '2' and deleted = '0'")->result_array();
		// echo "<pre>"; print_r($data['oprator']); die();
        $this->load->view('admin',$data);
	}

	function update_service_qty($id) {
		// echo "<pre>"; print_r($this->input->post()); die();
		$post = $this->input->post();
		$contract_schedule_id = $post['contract_schedule_id'];

		$update['product_qty'] = $post['complaint_qty'];
		$this->db->where("contract_schedule_detail_id", $id);
		$this->db->update("contract_schedule_detail", $update);

		redirect("contract_complaint/edit/".$contract_schedule_id);
	}

	function update_package_qty($id) {
		// echo "<pre>"; print_r($this->input->post()); die();
		$post = $this->input->post();
		$contract_schedule_id = $post['contract_schedule_id'];

		$update['package_qty'] = $post['package_qty'];
		$this->db->where("contract_schedule_detail_id", $id);
		$this->db->update("contract_schedule_detail", $update);

		redirect("contract_complaint/edit/".$contract_schedule_id);
	}

	function update_teknisi($id) {
		$post = $this->input->post();
		// echo "<pre>"; print_r($id); die();
		$contract_schedule_id = $post['contract_schedule_id'];

		$update['teknisi_id'] = $post['teknisi_id'];
		$this->db->where("contract_teknisi_id", $id);
		$this->db->update("contract_teknisi", $update);

		redirect("contract_complaint/edit/".$contract_schedule_id);
	}

	function delete($id) {
		$this->global_model->delete_data($id, "contract_schedule_id", "contract_schedule");
        $this->global_model->delete_data($id, "contract_schedule_id", "contract_schedule_detail");
        $this->global_model->delete_data($id, "contract_schedule_id", "contract_teknisi");
		redirect("contract_complaint");
	}
}