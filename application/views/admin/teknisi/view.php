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
							<th>Teknisi Name</th>
							<th>Type</th>
							<th>Teknisi Phone</th>
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
							<td><?php echo $data[$i]["teknisi_name"];?></td>
							<td>
								<?php 
									if ($data[$i]["teknisi_type"] == '1') {
										echo "Installer";
									}else{
										echo "Teknisi";
									}
								?>
							</td>
							<td><?php echo $data[$i]["teknisi_phone"];?></td>
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["teknisi_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["teknisi_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["teknisi_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are You Sure You Want to Delete <?php echo $data[$i]["teknisi_name"];?> from Teknisi Table?')"><b>Delete</b></a>
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