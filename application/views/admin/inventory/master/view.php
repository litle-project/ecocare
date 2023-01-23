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
							<th>Product Name</th>
							<th>Product Code</th>
							<th>Product Category</th>
							<th>Gudang Name</th>
							<th>Branch Name</th>
							<th>Product Stock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
							if ($data[$i]["category_id"] == 1 || $data[$i]["category_name"] == "UNIT" || $data[$i]["category_name"] == "Unit" || $data[$i]["category_name"] == "unit") {
									$btn_disable = "disabled";
							}elseif ($data[$i]['aroma'] == 0) {
									$btn_disable = "disabled";
							}else{
									$btn_disable = "";
							}
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["product_name"];?></td>
							<td><?php echo $data[$i]["product_code"];?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<td><?php echo $data[$i]["gudang_name"];?></td>
							<td><?php echo $data[$i]["branch_name"];?></td>
							
							<?php 
								if($data[$i]["product_stock"] > $data[$i]["min_stock"]) { ?>
									<td><?php echo $data[$i]["product_stock"];?></td>
							<?php }else{ ?>
								<td><b style="color:red;"><?php echo $data[$i]["product_stock"];?></b></td>
							<?php } ?>

							<td>
								<a href="<?php echo site_url("inventory_master/detail?inventory_id=".$data[$i]['inventory_id']."&branch_id=".$data[$i]['branch_id']."&gudang_id=".$data[$i]['gudang_id']."&product_id=".$data[$i]['product_id']."");?>" class="btn btn-sm blue" <?php echo $btn_disable; ?>><b>View Aroma</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/delete/".$data[$i]["inventory_id"]."");?>" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete <?php echo $data[$i]["product_name"];?> from product table? ')"><b>Delete</b></a>
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