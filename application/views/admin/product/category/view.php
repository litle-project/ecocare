<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
					<tr>
						<th>No</th>
						<th>Cat ID</th>
						<th>Category Name</th>
						<th>Category Description</th>
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
							<td><?php echo $data[$i]["category_id"];?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<td><?php echo word_limiter(strip_tags($data[$i]["category_desc"]),7);?></td>
							<td>
								<a href="<?php echo site_url("product_category/detail/".$data[$i]["category_id"]."");?>" class="btn btn-sm default"><b>Details</b></a>
								<a href="<?php echo site_url("product_category/edit/".$data[$i]["category_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
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
