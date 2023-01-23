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
						<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_discount/add");?>'">
						Set Discount <i class="fa fa-plus"></i>
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
						<th>Day</th>
						<th>Treatment & Discount</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$row=$get_data;
					$day = array(
								"1" => "Senin",
								"2" => "Selasa",
								"3" => "Rabu",
								"4" => "Kamis",
								"5" => "Jum'at",
								"6" => "Sabtu",
								"7" => "Minggu",
								);
								
					for($i=0; $i<count($row); $i++){
				?>
				<tr class="odd gradeX">
					<td>
						<?php
							echo ($i+1);
						?>
					</td>
					
					<td>
						<?php echo $day[$row[$i]["day"]];?>
					</td>
					<td>
						<table class="table table-striped table-bordered">
							<tr>
								<th width="50%">Treatment</th>
								<th width="25%">Price</th>
								<th width="25%">Discount</th>
							</tr>
							<?php
								for($j=0; $j<count($row[$i]["treat"]); $j++){
							?>
							<tr>
								<td><?php echo $row[$i]["treat"][$j]["treatment_name"];?></td>
								<td><?php echo "Rp ".number_format($row[$i]["treat"][$j]["treatment_price"],2);?></td>
								<td><?php echo $row[$i]["disc"][$j];?></td>
							</tr>
							<?php
								}
							?>
						</table>
					</td>
					<td>
						<a href="<?php echo site_url("admin_discount/add/".$row[$i]["day"]."");?>" class="btn blue">Edit</a>
					</td>
					<td>
						<a href="<?php echo site_url("admin_discount/delete/".$row[$i]["day"]."");?>" class="btn red" onclick="return confirm('Are you sure???');">Delete</a>
					</td>
				</tr>
				<?php
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