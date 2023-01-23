<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_discount extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_discount_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Discount";
		$data["page"]="discount/view";
		
		$data["get_data"]=$this->admin_discount_model->get_data();
		
		//print_r("<pre>");
		//print_r($data["get_data"]);
		//print_r("</pre>");
		$this->load->view('admin',$data);
	}
	
	
	function add($day=1){
		priv("add");
		
		
		if($this->input->post()){
			
			$post = $this->input->post();
			
			$day = $post["day"];
			
			//print_r("<pre>");
			//print_r($post["disc"]);
			//print_r("</pre>");
			
			foreach($post["disc"] as $key=>$value){
				if($value){
					$tid[] = $key;
					$tval[] = $value;
					//echo $key." = ".$value;
				}
			}
			
			
			if(count($tid) > 0){
				$imptid = implode(",",$tid);
				$imptval = implode(",",$tval);
				
				
				$data = array(
							"day" => $day,
							"branch_id" => $this->session->userdata("branch_id"),
							"treatment_id" => $imptid,
							"discount_price" => $imptval,
							"created_date" => "now()",
							"created_by" => $this->session->userdata("admin_id"),
				
							);
				
				$cek = $this->admin_discount_model->cek_day($day);
				if($cek > 0){
					$this->db->where("branch_id",$this->session->userdata("branch_id"));
					$this->db->where("day",$day);
					$this->db->update("discount",$data);
					
					$action="Set Discount Branch ID ".$this->session->userdata("branch_id")."day ".$day;
					$this->Aktiviti_log_model->create($action);
					
				}else{
					$action="Set Discount Branch ID ".$this->session->userdata("branch_id")."day ".$day;
					$this->Aktiviti_log_model->create($action);
					$this->db->insert("discount",$data);
				}
				
				
				
				redirect("admin_discount");
			
			}
			
			
			
			
		}
		
		
		
		
		$data["title"]="Discount";
		$data["page"]="discount/add";
		
		$data["day"]=$this->admin_discount_model->get_day();
		$data["get_treatment_price"]=$this->admin_discount_model->get_treatment_price();
		$data["get_discount"]=$this->admin_discount_model->get_discount($day);
		
	
		
		$this->load->view('admin',$data);
	}
	
	function delete($day){
		
		$data["deleted"] = "1";
		
		$this->db->where("day",$day);
		$this->db->where("branch_id",$this->session->userdata("branch_id"));
		$this->db->update("discount",$data);
		$action="Delete Discount Branch ID ".$this->session->userdata("branch_id")."day ".$day;
		$this->Aktiviti_log_model->create($action);
		redirect("admin_discount");
		
		
	}
	
	

}
