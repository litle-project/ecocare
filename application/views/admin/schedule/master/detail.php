<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">List Assignment</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<br><br><br><br>
	<div class="col-md-12 col-sm-12">
		<br/><br/>
		<div class="row">
			<h3 style="padding-top:0;">LIST SCHEDULE FOR CONTRACT <?php echo $data[0]['contract_no'];?></h3>
			<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
				<div class="portlet box grey">
					<div class="portlet-body">										
						<table class="table table-striped table-bordered table-hover display">
							<thead>
								<tr>
									<th>No</th>
									<th>Schedule Type</th>
									<th>Schedule date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="selected_only">
							<?php
								$no=1;
								foreach($data as $row){

								if ($row['schedule_type'] == 1){
									$type = "Install";
								}elseif ($row['schedule_type'] == 2) {
									$type = "Service";
								}elseif ($row['schedule_type'] == 3) {
									$type = "Termination";
								}elseif ($row['schedule_type'] == 4) {
									$type = "Complaint";
								}elseif ($row['schedule_type'] == 5) {
									$type = "Special Request";
								}
							?>
								<tr class="gradeX">
									<td><?php echo $no;?></td>
									<td><?php echo $type; ?></td>
									<td><?php echo $row["schedule_date"];?></td>
									<td>
										<a href="<?php echo site_url("schedule_master/detail_contract?contract_id=".$row['contract_id']."&contract_schedule_id=".$row['contract_schedule_id']."&parent_schedule_id=".$row['parent_schedule_id']."");?>" class="btn btn-sm blue"><b>Detail Contract</b></a>
									</td>
								</tr>
							<?php $no++; } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions fluid col-md-12">
			<center>
				<button type="button" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
			</center>
		</div>
	</div>
</div>
<script>
    $(document).ready(function () {
        $('table.display').dataTable();
    });
</script>