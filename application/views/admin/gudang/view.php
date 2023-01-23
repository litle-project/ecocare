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
							<th>Warehouse Name</th>
							<th>Warehouse Address</th>
							<th>Branch</th>
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
							<td><?php echo $data[$i]["gudang_name"];?></td>
							<td><?php echo word_limiter($data[$i]["gudang_address"],9);?></td>
							<td><?php echo $data[$i]["branch_name"];?></td>
							<td><a href="<?php echo site_url($this->uri->segment(1)."/stock?gudang_id=".$data[$i]["gudang_id"]."&branch_id=".$data[$i]["branch_id"]."");?>" class="btn btn-sm default"><b>Check Stock</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["gudang_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["gudang_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["gudang_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["gudang_name"];?> from gudang table? ')"><b>Delete</b></a>
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