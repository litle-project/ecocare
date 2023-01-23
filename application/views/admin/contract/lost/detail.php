<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Contract Product Lost</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/><br/>
		<form action="" method="post" autocomplete="off" class="form-horizontal" enctype='multipart/form-data'>
			<div class="row">
				<div class="form-body col-md-12">
                    <div class="form-group">
						<label class="col-md-5 control-label"><b>Termination Date :</b></label>
						<label class="control-label"><?php echo $data[0]['termination_date']?></label>
					</div>
					<?php $no=1; foreach ($teknisi as $key) { ?>
						<div class="form-group">
							<label class="col-md-5 control-label"><b>Teknisi <?php echo $no; ?>:</b></label>
							<label class="control-label"><?php echo $key['teknisi_name']?></label>
						</div>
					<?php $no++; } ?>
					<div class="form-group">
						<label class="col-md-5 control-label"><b>Customer :</b></label>
						<label class="control-label"><?php echo $data[0]['customer_name']?></label>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label"><b>Address :</b></label>
						<label class="control-label"><?php echo $data[0]['address']?></label>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label"><b>Contract No :</b></label>
						<label class="control-label"><?php echo $data[0]['contract_no']?></label>
					</div>
				</div>
			</div>

			<div class="row">
				<?php if(!empty($product)) { ?>
				<h3 style="padding-top:0;">PRODUCT</h3>
				<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
					<div class="portlet box grey">
						<div class="portlet-body">										
							<table class="table table-striped table-bordered table-hover display">
								<thead>
									<tr>
										<th>No</th>
										<th>Product Code</th>
										<th>Product Name</th>
										<th>Product Category</th>
										<th>Lost Qty</th>
									</tr>
								</thead>
								<tbody class="selected_only">
								<?php
									$no=1;
									for($i=0; $i <count($product) ; $i++){
								?>
									<tr class="gradeX">
										<td><?php echo $no;?></td>
										<td><?php echo $product[$i]["product_code"];?></td>
										<td><?php echo $product[$i]["product_name"];?></td>
										<td><?php echo $product[$i]["category_name"];?></td>
										<td><?php echo $product[$i]["lost_qty"];?></td>
									</tr>
								<?php $no++; } ?>
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="form-actions fluid col-md-12">
				<center>
					<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
				</center>
			</div>
		</form>
	</div>
</div>