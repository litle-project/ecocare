<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">package</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>

				<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Package Name</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" name="package_name" readonly value="<?php echo $data[0]['package_name']?>" class="form-control" placeholder="Package Name" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Package Description</label>
						<div class="col-md-8 col-sm-8">
							<textarea class="form-control ckeditor" readonly name="package_desc"><?php echo $data[0]['package_desc']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Package Quantity</label>
						<div class="col-md-8 col-sm-8">
							<input type="number" min="1" readonly value="<?php echo $data[0]['package_qty']?>" name="package_qty" placeholder="Example 10 Package" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Package Price</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" min="1" readonly value="<?php echo $data[0]['package_price']?>" name="package_price" placeholder="Example Rp.100.000" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-6" style="padding-top: 20px;">
						<h3>Product On This Package</h3>
						<div class="portlet box grey">
							<div class="portlet-body">										
								<table class="table table-striped table-bordered table-hover display">
									<thead>
										<tr>
											<th>No</th>
											<th>Product Code</th>
											<th>Product Name</th>
											<th>Product Category</th>
											<th>Total Per Install</th>
											<th>Total Per Service</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no=1;
										for($i=0; $i <count($product) ; $i++){
									?>
										<tr class="gradeX">
											<td><?php echo $no;?></td>
											<td><?php echo $product[$i]["product_code"];?></td>
											<td><?php echo $product[$i]["product_name"];?></td>
											<td><?php echo $product[$i]["category_name"];?></td>
											<td><?php echo $product[$i]['total_per_install'];?></td>
											<td><?php echo $product[$i]['total_per_service'];?></td>
										</tr> 
									<?php $no++; }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
						</center>
					</div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>