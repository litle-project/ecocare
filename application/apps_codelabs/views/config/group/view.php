<?php
	//print_r("<pre>");
	//print_r($menu_privileges);
	//print_r("</pre>");
?>

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
								<!--
									<button class="btn green" onclick="window.location.href='<?php echo site_url("motivation/add");?>'">
									Add New <i class="fa fa-plus"></i>
									</button>
								-->
								<button class="btn green" onclick="window.location.href='<?php echo site_url("config/group_add");?>'">Add New<i class="fa fa-plus"></i>
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
				<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-hover table-bordered" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Group Manu Name</th>
							<th>Description</th>
							<th>Edit</th>
							<th>Delete</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach($data as $row)
							{
						?>
								<tr class="gradeX">
									<td><?php echo $no;?></td>
									<td><?php echo $row['group_menu_name'];?></td>
									<td><?php echo $row['group_menu_desc'];?></td>
									<td><a href="<?php echo site_url("config/group_edit/".$row["group_menu_id"]."");?>"><button type="button"  class="btn green">Edit</button></a></td>
									<td><a href="<?php echo site_url("config/group_delete/".$row["group_menu_id"]."");?>" onclick="return confirm('Are You Sure Delte This Item???');"><button type="button" class="btn green">Delete</button></a></td>
									
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