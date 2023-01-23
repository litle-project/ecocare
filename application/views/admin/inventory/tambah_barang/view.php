<h1>This Is List Log History Of Inventory</h1>
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
							<th>Added From</th>
							<th>Branch Name</th>
							<th>Gudang Name</th>
							<th>Product Stock</th>
							<th>Created Date</th>
							<th>Status Inventory</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
						$date = explode(" ",$data[$i]['created_date']);
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["product_name"];?></td>
							<td><?php echo $data[$i]["product_code"];?></td>
							<td>
								<?php 
									if ($data[$i]["insert_from"] == '1') {
										echo "Added From Inventory";
									}elseif($data[$i]["insert_from"] == '2'){
										echo "Added From Tambah Barang";
									}else{
										echo "Added From Return Barang";
									}
								?>
							</td>
							<td><?php echo $data[$i]["branch_name"];?></td>
							<td><?php echo $data[$i]["gudang_name"];?></td>
							<td><?php echo $data[$i]["product_add_qty"];?></td>
							<td><?php echo $date[0];?></td>
							<td>
								<?php 
									if ($data[$i]["status"] == '1') { ?>
										<span style="background-color: #1cd063; color:white; padding: 5px 22px 5px 22px !important;">Active</span>
								<?php }else{ ?>
										<span style="background-color: #dc4141; color:white; padding: 5px 22px 5px 22px !important;">Inactive</span>
								<?php } ?>
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