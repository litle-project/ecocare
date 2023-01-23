<?php
	//print_r("<pre>");
	//print_r($menu_privileges);
	//print_r("</pre>");
?>
<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

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
								<button class="btn green" onclick="window.location.href='<?php echo site_url("config/menu_add");?>'">Add New<i class="fa fa-plus"></i>
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
							<th>Menu Name</th>
							<th>Menu Desc</th>
							<th>Menu Url</th>
							<th>Group Menu</th>
							<th>V</th>
							<th>A</th>
							<th>E</th>
							<th>D</th>
							<th>O</th>
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
							<td><?php echo $row["menu_name"];?></td>
							<td><?php echo $row["menu_desc"];?></td>
							<td><?php echo $row["menu_url"];?></td>
							<td><?php echo $row["group_menu_name"];?></td>
							<td><?php echo $row["menu_view"];?></td>
							<td><?php echo $row["menu_add"];?></td>
							<td><?php echo $row["menu_edit"];?></td>
							<td><?php echo $row["menu_delete"];?></td>
							<td><?php echo $row["menu_other"];?></td>
							<td>
								<input type="button" value="Edit" class="button blue-gradient" onclick="window.location.href='<?php echo site_url("config/menu_edit/".$row["menu_id"]);?>'">
							</td>
							<td>
								<input type="button" value="Delete" class="button blue-gradient" onclick="del_confirm('Are You Sure Delete This Item???','<?php echo site_url("config/menu_delete/".$row["menu_id"]);?>')">
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
			
			<script>
function del_confirm(msg,url)
        {
            if(confirm(msg))
            {
                window.location.href=url
            }
            else
            {
                false;
            }

        }
</script>