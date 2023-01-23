<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
					<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/add");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Add New</b></button>
					<button class="btn green" onclick="window.location.href='<?php echo site_url($this->uri->segment(1)."/import");?>'"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp;<b>Import</b></button>
				</div>
				
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Contract No</th>
							<th>Customer</th>
							<th>Contract Purpose</th>
							<th>Renew</th>
							<th>Termination</th>
							<th>Action</th>
							<th>Print</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data); $i++){
							// $disabled = "";
							if($data[$i]["terminate"]=="1") {
								$disabled = "disabled";
							}
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td><?php echo $data[$i]["customer_name"];?></td>
							<td>
								<?php 
									if ($data[$i]["contract_purpose"] == 1) {
										echo "Install";
									} elseif ($data[$i]["contract_purpose"] == 2) {
										echo "Service";
									} elseif ($data[$i]["contract_purpose"] == 3) {
										echo "Replace";
									} elseif ($data[$i]["contract_purpose"] == 4) {
										echo "Termination";
									} elseif ($data[$i]["contract_purpose"] == 5) {
										echo "Complain";
									} elseif ($data[$i]["contract_purpose"] == 6) {
										echo "Trial";
									} elseif ($data[$i]["contract_purpose"] == 7) {
										echo "DO";
								} ?>
							</td>
							<td style="color:green;"><?php if($data[$i]["renew"]=="1"){echo "Renew";}else{echo "-";}?></td>
							<td style="color:red;"><?php if($data[$i]["terminate"]=="1"){echo "Terminated";}else{echo "-";}?></td>
							
							<td>
								<a href="<?php echo site_url($this->uri->segment(1)."/renew/".$data[$i]["contract_id"]."");?>" class="btn btn-sm green"><b>Renew</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["contract_id"]."");?>" class="btn btn-sm blue" <?php if(!empty($disabled)) {echo $disabled;}?>><b>Edit</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["contract_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["contract_no"];?> from product table? ')"><b>Delete</b></a>
							</td>
							<td>
								<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["contract_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/print_ia/".$data[$i]["contract_id"]."");?>" class="btn btn-sm blue"><b>IA</b></a>
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