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
								<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_privileges/add");?>'">Add New<i class="fa fa-plus"></i>
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
							<th>User Group</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Privileges</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach($user_group as $row)
							{
						?>
								<tr class="gradeX">
									<td><?php echo $no;?></td>
									<td><?php echo $row['user_group_name'];?></td>
									<?php
										if($row["user_group_id"]){
									?>
									<td><a href="<?php echo site_url("admin_privileges/edit/".$row["user_group_id"]."");?>"><button type="button"  class="btn blue">Edit</button></a></td>
									<td><a href="<?php echo site_url("admin_privileges/delete/".$row["user_group_id"]."");?>" onclick="return confirm('Are You Sure Delte This Item???');"><button type="button" class="btn red">Delete</button></a></td>
									<td><a href="<?php echo site_url("admin_privileges/privileges/".$row["user_group_id"]."");?>"><button type="button" class="btn green">Privileges</button></a></td>
									<?php
										}else{
									?>
									<td></td>
									<td></td>
									<td></td>
									<?php
										}
									?>
								</tr>
						<?php
							$no++;
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>No</th>
							<th>User Group</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Privileges</th>
						</tr>
					</tfoot>	
				</table>
			</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->