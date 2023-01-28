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
							<th>Prod ID</th>
							<th>Product Name</th>
							<th>Product Code</th>
							<th>Product Category</th>
							<th>Aroma</th>
							<th>Product ID</th>
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
							<td><?php echo $data[$i]["product_id"];?></td>
							<td><?php echo $data[$i]["product_name"];?></td>
							<td><?php echo $data[$i]["product_code"];?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<td>
								<?php if ($data[$i]['aroma'] == 1) {
									echo "Have Aroma";
								}else{
									echo "Haven't Aroma";
								} ?>
							</td>
							<td><?php echo $data[$i]["product_id"];?></td>
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["product_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["product_id"]."");?>" class="btn btn-sm blue"><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["product_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["product_name"];?> from product table? If It is product with aroma, the aroma will deleted too!')"><b>Delete</b></a>
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