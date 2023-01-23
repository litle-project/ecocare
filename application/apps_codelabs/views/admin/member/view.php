<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i><?php echo $title;?>
							</div>
							
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="btn-group">
									<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_member/add");?>'">
									Add New <i class="fa fa-plus"></i>
									</button>
								</div>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">Print</a>
										</li>
										<li>
											<a href="#">Save as PDF</a>
										</li>
										<li>
											<a href="#">Export to Excel</a>
										</li>
									</ul>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
								<tr>
									<th>No</th>
									<th>Member No</th>
									<th>Member Name</th>
									<th>Member Telp</th>
									<th>Member Address</th>
									<th>Member Image</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no=1;
								foreach($get_data as $row){
							?>
							<tr class="odd gradeX">
								<td>
									<?php
										echo $no;
									?>
								</td>
								
								<td>
									<?php echo $row["member_no"];?>
								</td>
								
								<td>
									<?php echo $row["member_name"];?>
								</td>
								<td>
									<?php echo $row["member_telp"];?>
								</td>
								<td>
									<?php echo word_limiter($row["member_address"],20);?>
								</td>
								<td>
									<img src="<?php echo base_url("media/member/low/".$row["member_photo"]."");;?>" width="200px">
								</td>
								<td>
									<a href="<?php echo site_url("admin_member/edit/".$row["member_id"]."");?>" class="btn blue">Edit</a>
								</td>
								<td>
									<a href="<?php echo site_url("admin_member/delete/".$row["member_id"]."");?>" class="btn red" onclick="return confirm('Are you sure???');">Delete</a>
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
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->