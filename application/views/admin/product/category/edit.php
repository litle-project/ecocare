<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Category</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-12">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
			<br/>
			<form action="<?php echo base_url('product_category/edit/'.$data[0]['category_id'].''); ?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 col-sm-6 control-label">Category Name</label>
					<div class="col-md-6 col-sm-6">
						<input type="text" name="category_name" class="form-control" value="<?php echo $data[0]['category_name'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 col-sm-6 control-label">Category Description</label>
					<div class="col-md-6 col-sm-6">
						<textarea class="form-control ckeditor" name="category_desc"><?php echo $data[0]['category_desc']?></textarea>
					</div>
				</div>
			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="submit" class="btn green"><b>Submit</b></button>
						<button type="reset" class="btn default"  id="reset" onclick="window.history.back()"><b>Back</b></button>
					</center>
				</div>
			</div>
			</form> 

			</div>
		</div>
	</div>
</div>