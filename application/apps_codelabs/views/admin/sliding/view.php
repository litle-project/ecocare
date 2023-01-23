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
									<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_sliding/add");?>'">
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
									<th>Sliding Title</th>
									<th>Sliding Desc</th>
									
									<th>Sliding Image</th>
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
									<?php
										echo $row["sliding_title"];
									?>
								</td>
								<td>
									<?php
										echo $row["sliding_desc"];
									?>
								</td>
								
								<td>
									<img width="50px" src="<?php echo base_url("media/sliding/" . $row["sliding_image"]);?>">
								</td>
								<td>
									<a href="<?php echo site_url("sliding/edit/".$row["sliding_id"]."");?>">Edit</a>
								</td>
								<td>
									<a href="<?php echo site_url("sliding/delete/".$row["sliding_id"]."");?>">Delete</a>
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