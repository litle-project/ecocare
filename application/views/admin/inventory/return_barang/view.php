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
							<th>Type</th>
							<th>Complaint/Terminate Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td>
								<?php if ($data[$i]["schedule_type"] == '4') { ?>
									<span style="background-color: #ffb848; color:white; padding: 5px 22px 5px 22px !important;">Complaint</span>
								<?php }else{ ?>
									<span style="background-color: #d43333; color:white; padding: 5px 10px 5px 10px !important;">Termination</span>
								<?php }?>
							</td>
							<td><?php echo date("l d-m-Y", strtotime($data[$i]["created_date"]));?></td>
							<td>
								<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]['contract_schedule_id']."");?>" class="btn btn-sm blue"><b>Return</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/print_rts/".$data[$i]['contract_schedule_id']."");?>" class="btn btn-sm yellow"><b>Print RTS</b></a>
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