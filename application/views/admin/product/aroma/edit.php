<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Product Aroma</a>
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
				<form action="<?php echo base_url('product_aroma/edit/'.$data[0]['product_aroma_id']);?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 col-sm-3 control-label">Product</label>
							<div class="col-md-8 col-sm-8">
								<select name="product_id" class="form-control" required>
								<?php if (!empty($data)) { 
									foreach ($product as $row) { ?> 
										<option <?php if($data[0]['product_id'] == $row['product_id']){ echo "selected"; } ?> value="<?php echo $row['product_id'];?>"><?php echo $row['product_name'];?></option>
								<?php }
									}else{ ?>
										<option value="">----Please Create Product With Material And Aroma!----</option>
								<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-sm-3 control-label">Product Aroma Name</label>
							<div class="col-md-8 col-sm-8">
								<input type="text" name="product_aroma_name" value="<?php echo $data[0]['product_aroma_name'];?>" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-12">
							<center>
								<button type="submit" class="btn green"><b>Submit</b></button>
								<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>