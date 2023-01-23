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
							<th>Schedule Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){

							if($data[$i]['terminate'] == "1"){
								$disabled = "disabled";
							}else{
								$disabled = "";
							}
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td>
							<?php
								if($data[$i]["schedule_type"] == "1"){
									echo "Install";
								}elseif($data[$i]["schedule_type"] == "2"){
									echo "Service";
								}elseif ($data[$i]["schedule_type"] == "3") {
									echo "Termination";
								}elseif ($data[$i]["schedule_type"] == "4") {
									echo "Complaint";
								}elseif ($data[$i]["schedule_type"] == "5") {
									echo "Special Request";
								}else{
									echo "<i> Undefined</i>";
								}
							 ?>
							 </td>
							<td>
								<a href="<?php echo base_url("schedule_mrur/detail?contract_id=".$data[$i]['contract_id']."&parent_schedule_id=".$data[$i]['parent_schedule_id']."&contract_schedule_id=".$data[$i]['contract_schedule_id']."");?>" class="btn btn-sm blue"><b>Detail</b></a>
								<a class="btn btn-sm green" <?php echo $disabled; ?> href="<?php echo base_url("schedule_mrur/request_material?contract_id=".$data[$i]['contract_id']."&parent_schedule_id=".$data[$i]['parent_schedule_id']."&contract_schedule_id=".$data[$i]['contract_schedule_id']."")?>">Request Material</a>
					
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

<h1><?php echo "Summary MR/UR For Next Week";?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">			
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Schedule Date</th>
							<th>Schedule Type</th>
							<th>Contract No</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no1=1;
						for($i=0; $i <count($date) ; $i++){
							if($date[$i]['terminate'] == "1"){
								$disabledWeek = "disabled";
							}else{
								$disabledWeek = "";
							}
					?>
						<tr class="gradeX">
							<td><?php echo $no1;?></td>
							<td><?php
									if(!empty($date[$i]["schedule_date"])){
								 		echo date("l d-m-Y", strtotime($date[$i]["schedule_date"])); 
									}else{
										echo "";
									} ?></td>
							<td>
							<?php
							if($date[$i]["schedule_type"] == "1"){
								echo "Install";
							}elseif($date[$i]["schedule_type"] == "2"){
								echo "Service";
							}elseif ($date[$i]["schedule_type"] == "3") {
								echo "Termination";
							}elseif ($date[$i]["schedule_type"] == "4") {
								echo "Complain";
							}elseif ($date[$i]["schedule_type"] == "5") {
								echo "Special Request";
							}else{
								echo "<i> Undefined</i>";
							}
							 ?>
							</td>
							<td><?php echo $date[$i]["contract_no"];?></td>
							<td>
								<a href="<?php echo base_url("schedule_mrur/detail?contract_id=".$date[$i]['contract_id']."&parent_schedule_id=".$date[$i]['parent_schedule_id']."&contract_schedule_id=".$date[$i]['contract_schedule_id']."");?>" class="btn btn-sm blue"><b>Detail</b></a>
								<a class="btn btn-sm green" <?php echo $disabledWeek; ?> href="<?php echo base_url("schedule_mrur/request_material?contract_id=".$date[$i]['contract_id']."&parent_schedule_id=".$date[$i]['parent_schedule_id']."&contract_schedule_id=".$date[$i]['contract_schedule_id']."")?>">Request Material</a>
							</td>
						</tr>
					<?php
							$no1++;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>