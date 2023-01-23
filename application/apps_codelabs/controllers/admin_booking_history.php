<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_booking_history extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_booking_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Booking History";
		$data["page"]="booking/history";
                if($this->input->post()){
                    $post=$this->input->post();
                    $branch_id=$post["branch_id"];
                    $date_start=$post["booking_start"];
                    $date_end=$post["booking_end"];
                    
                    $data["get_data"]=$this->admin_booking_model->get_history($branch_id,$date_start,$date_end);
                }
                else{
                    $data["get_data"]=$this->admin_booking_model->get_history();
                }
		
                //print_r("<pre>");
                //print_r($data["get_data"]);
                //print_r("</pre>");
                $data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
		$this->load->view('admin',$data);
	}
	
	
	function detail_booking(){
		$id = $this->input->get("id");
		$date = $this->input->get("date");
		
		
		$sql = "select * from booking as a 
				left join branch as b on b.branch_id=a.branch_id
				left join member as c on c.member_id=a.member_id
				where a.deleted = '0' AND a.member_id = '".$id."' AND a.booking_date='".$date."'";
		$query = $this->db->query($sql);
		$hasil = $query->row_array();
		
		
		
		
		
		echo '
		<table style="width:100%">
			<tr>
				<td>Member Name</td>
				<td>:</td>
				<td>'.$hasil["member_name"].'</td>
			</tr>
			<tr>
				<td>Branch Name</td>
				<td>:</td>
				<td>'.$hasil["branch_name"].'</td>
			</tr>
			<tr>
				<td>Booking Date</td>
				<td>:</td>
				<td>'.$hasil["booking_date"].'</td>
			</tr>
		</table>';
		
		echo '<br>';
		
		
		
		
		echo '
			<table style="width:100%" border="1">
			<tr>
				<th width="20%">Time</th>
				<th width="40%">Treatment</th>
				<th width="40%">Stylist</th>
			</tr>
			';
			
		$sql2 = "select * from booking as a
				LEFT JOIN member as b ON b.member_id=a.member_id
				LEFT JOIN booking_detail as z on z.booking_id=a.booking_id
				LEFT JOIN treatment_price as c ON c.treatment_price_id=z.treatment_price_id
				LEFT JOIN stylist_price as d ON d.stylist_price_id=z.stylist_price_id
				LEFT JOIN treatment as e ON e.treatment_id=c.treatment_id
				LEFT JOIN stylist as f ON f.stylist_id=d.stylist_id
				LEFT JOIN branch as g on g.branch_id=a.branch_id
				
				WHERE a.deleted='0'
				and a.member_id = '".$id."'
				and a.booking_date = '".$date."'
				and a.branch_id = '".$this->session->userdata('branch_id')."'
				
				order by a.booking_time asc
				";
		
		//echo $sql2;
		$query2 = $this->db->query($sql2);
		
		
		foreach($query2->result_array() as $row){
			
			echo '
				<tr>
					<td>'.$row['booking_time'].'</td>
					<td>'.$row['treatment_name'].'</td>
					<td>'.$row['stylist_name'].'</td>
				</tr>
				';
		}
			
		echo '</table>';
	}
	
	

}
