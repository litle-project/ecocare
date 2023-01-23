<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Contract No</th>
							<th>Branch Name</th>
							<th>Stock Rquested</th>
							<th>Request Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
						if ($data[$i]['status'] == '1') {
							$disabled = 'disabled';
						}else{
							$disabled = '';
						}

						if ($data[$i]['status'] == '0') {
							$disable = 'disabled';
						}else{
							$disable = '';
						}
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td><?php echo $data[$i]["branch_name"];?></td>
							<td><?php echo $data[$i]["total_product"];?></td>
							<td><?php echo date("l d-m-Y", strtotime($data[$i]["created_date"]));?></td>
							<td>
								<?php if ($data[$i]["status"] == '0') { ?>
									<span style="background-color: #ffb848; color:white; padding: 5px 22px 5px 22px !important;">Requested</span>
								<?php }else{ ?>
									<span style="background-color: #d6d6d6; color:#908d8d; padding: 5px 10px 5px 10px !important;">Prepared</span>
								<?php }?>
							</td>
							<td>
								<a <?php echo $disable; ?> href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]['contract_history_id']."");?>" class="btn btn-sm blue"><b>View Detail</b></a>
								<a <?php echo $disabled; ?> href="<?php echo site_url($this->uri->segment(1)."/edit?contract_history_id=".$data[$i]['contract_history_id']."&contract_id=".$data[$i]['contract_id']."&contract_schedule_id=".$data[$i]['contract_schedule_id']."");?>" class="btn btn-sm green"><b>Edit</b></a>
							</td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>