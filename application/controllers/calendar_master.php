<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendar_master extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("calendar_model");
		$this->load->model("global_model");
		$page=$this->uri->segment(2);
	}
	
	public function index()
	{
		priv("view");
		$data["data"] 	= $this->calendar_model->get_data();
		$data["page"]	="calendar/view";
		$data["title"]	="Manage Calendar";

		$this->load->view('admin',$data);
	}

	public function detail($value='')
	{
		priv("view");
		$data["page"]	= "calendar/detail";
		$data["title"]	= "How To Use";

		$this->load->view('admin',$data);
	}

	function generate() {
		priv("add");
		$today = getdate();
		// $year = $today["year"];
		$month = $today["mon"];
		if($this->input->post()) {
			$month = $this->input->post("month");
			$year = $this->input->post("year");
		}
		$check = $this->calendar_model->check_if_calendar_not_exist($year,$month);
		if($check == TRUE) {
			$number = cal_days_in_month(CAL_GREGORIAN,$month,$year);
			$work_day = 1;
			$working_days = array();
			for ($i=1; $i<=$number; $i++) { 
				$date0 = $year."-".$month."-".$i;
				$date = strtotime($date0);
				$week = date("w",$date);
				if($week != 0 and $week != 6) 
				{
					$data = array(
						"calendar_year"=>$year,
						"calendar_month"=>$month,
						"working_day"=>$work_day,
						"calendar_date"=>$date0,
						"created_date"=>date("Y-m-d H:i:s"),
						"created_by"=>$this->session->userdata["admin_id"],
						"deleted"=>"0"
						);
					$this->db->insert("calendar", $data);
					$work_day++;
				}
			}
		} else {
			echo "FALSE";
		}
		redirect("calendar_master");
	}

	function delete($id) {

        $this->global_model->delete_data($id, "calendar_id", "calendar");
		redirect("calendar_master");
	}
}