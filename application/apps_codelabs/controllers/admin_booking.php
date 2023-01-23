<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_booking extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_booking_model");
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Booking";
		$data["page"]="booking/view";
		//$data["get_data"]=$this->admin_booking_model->get_data();
		$this->load->view('admin',$data);
	}
	
	
	
	function json_booking(){
		$get_data=$this->admin_booking_model->get_data();
		
		
		
		if(count($get_data) > 0){
			for($i=0; $i<count($get_data); $i++){
				$a = $get_data[$i]["booking_date"]." ".$get_data[$i]["booking_time"];
				$data=array(	
								'date' => $a,
								'type' => "booking",
								'title' => "Booking ".$get_data[$i]["member_name"]."<p style='display:none'>".$get_data[$i]["booking_id"]."</p>",
								'description' => "Booking <b>".$get_data[$i]["member_name"]."</b>",
								'url' => "#"
							);
							
				$all[]=$data;
				//echo $a."<br>";
			}
		
		
			
			
		}else{
			$data=array(	
								'date' => "1996-01-01 12:00:00",
								'type' => "",
								'title' => "",
								'description' => "",
								'url' => ""
							);
			$all[]=$data;
		}
		
		echo json_encode($all);
		
	}
	
	
	function detail_booking(){
		$id = $this->input->get("id");
		//$date = $this->input->get("date");
		
		
		$sql = "select * from booking as a 
				left join branch as b on b.branch_id=a.branch_id
				left join member as c on c.member_id=a.member_id
				where a.deleted = '0' AND a.booking_id = '".$id."'";
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
			<table style="width:100%" border="1" class="table table-striped table-hover table-bordered">
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
				and a.booking_id = '".$id."'
				
				order by z.booking_time asc
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
