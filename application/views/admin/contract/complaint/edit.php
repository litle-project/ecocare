<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Contract Special Complaint</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<br><br><br><br>
	<div class="col-md-12 col-sm-12">
		<br/><br/>
		<div class="row">
			<h3 style="padding-top:0;">DETAIL SERVICE PRODUCT</h3>
			<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
				<div class="portlet box grey">
					<div class="portlet-body">										
						<table class="table table-striped table-bordered table-hover display">
							<thead>
								<tr>
									<th>No</th>
									<th>Product</th>
									<th>Category</th>
									<th>Quantity</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="selected_only">
							<?php
								$no=1;
								foreach($product as $row){
							?>
								<tr class="gradeX">
									<form action="<?php echo site_url($this->uri->segment(1)."/update_service_qty/".$row['contract_schedule_detail_id']."")?>" method="post">
									<td><?php echo $no;?></td>
									<td>
										<?php if (!empty($row["package_name"])) {
											echo $row["package_name"];
										}else{
											echo "No Package Selected";
										} ?>
									</td>
									<td><?php echo $row["product_name"];?></td>
									<td><?php echo $row["category_name"];?></td>
									<td>
										<input type="hidden" name="contract_schedule_id" value="<?php echo $product[0]['contract_schedule_id'];?>">
										<input name="complaint_qty" value="<?php echo $row["product_qty"];?>" type="number" min="0" max="" class='form-control' required>
									</td>
									<td>
										<button type="submit" class="btn blue"><b>Update</b></button>
									</td>
									</form>
								</tr>
							<?php $no++; } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- //// -->
		<div class="row">
			<h3 style="padding-top:0;">DETAIL SERVICE PACKAGE</h3>
			<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
				<div class="portlet box grey">
					<div class="portlet-body">										
						<table class="table table-striped table-bordered table-hover display">
							<thead>
								<tr>
									<th>No</th>
									<th>Package</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="selected_only">
							<?php
								$no=1;
								foreach($package as $row){
							?>
								<tr class="gradeX">
									<form action="<?php echo site_url($this->uri->segment(1)."/update_package_qty/".$row['contract_schedule_detail_id']."")?>" method="post">
									<td><?php echo $no;?></td>
									<td><?php echo $row["package_name"];?></td>
									<td><?php echo $row["package_price"];?></td>
									<td>
										<input type="hidden" name="contract_schedule_id" value="<?php echo $package[0]['contract_schedule_id'];?>">
										<input name="package_qty" value="<?php echo $row["package_qty"];?>" type="number" min="0" max="" class='form-control' required>
									</td>
									<td>
										<button type="submit" class="btn blue"><b>Update</b></button>
									</td>
									</form>
								</tr>
							<?php $no++; } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- //// -->
		<div class="row">
			<h3 style="padding-top:0;">DETAIL INSTALLER/TEKNISI</h3>
			<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
				<div class="portlet box grey">
					<div class="portlet-body">										
						<table class="table table-striped table-bordered table-hover display">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="selected_only">
							<?php
								$no=1;
								foreach($oprator as $row){
							?>
								<tr class="gradeX">
									<form action="<?php echo site_url($this->uri->segment(1)."/update_teknisi/".$row['contract_teknisi_id']."")?>" method="post">
									<td><?php echo $no;?></td>
									<td>
										<input type="hidden" name="contract_schedule_id" value="<?php echo $oprator[0]['contract_schedule_id'];?>">
										<select name="teknisi_id" class="form-control" required>
											<?php foreach($teknisi as $key){?>
												<option <?php if($row['teknisi_id'] == $key['teknisi_id']){ echo "selected"; }?> value="<?php echo $key['teknisi_id']?>"><?php echo $key['teknisi_name']?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<button type="submit" class="btn blue"><b>Update</b></button>
									</td>
									</form>
								</tr>
							<?php $no++; } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions fluid col-md-12">
			<center>
				<button type="reset" class="btn black" onclick="window.location.href='<?php echo base_url("contract_complaint")?>';"  id="reset"><b>Back</b></button>
			</center>
		</div>
	</div>
</div>
<script>
    $(document).ready(function () {
        $('table.display').dataTable();
    });
</script>