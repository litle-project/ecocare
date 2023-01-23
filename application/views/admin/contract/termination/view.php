<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
				</div>
				
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Contract No</th>
							<th>Termination Date</th>
							<th>Action</th>
							<th>Print</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data); $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td><?php echo date("l d-m-Y", strtotime($data[$i]['schedule_date'])); ?></td>
							<td>
								<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["contract_schedule_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["contract_schedule_id"]."");?>" class="btn btn-sm blue" <?php if(!empty($disabled)) {echo $disabled;}?>><b>Edit</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["contract_schedule_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["contract_no"];?> from product table? ')"><b>Delete</b></a>
							</td>
							<td>
								<a href="<?php echo site_url($this->uri->segment(1)."/print_ba/".$data[$i]["contract_schedule_id"]."");?>" class="btn btn-sm green"><b>Print BA</b></a>
							</td>
						</tr>
					<?php
							$no++;
							$disabled ="";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>