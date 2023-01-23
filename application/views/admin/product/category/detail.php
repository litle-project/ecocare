<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Category</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
		<br/>
	<div class="col-md-12 col-sm-12">
		<div class="portlet box grey">
			<div class="portlet-body form">
			<br/>
			<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-5 col-sm-6 control-label"><b>Category Name : </b></label>
					<label class="control-label"><?php echo $data[0]['category_name'];?></label>
				</div>
				<div class="form-group">
					<label class="col-md-5 col-sm-6 control-label"><b>Category Description : </b></label>
					<label class="control-label"><?php echo $data[0]['category_desc']?></label>
				</div>
			</div>
			<div class="form-actions fluid">
				<div class="col-md-12">
					<center>
						<button type="button" class="btn default" onclick="window.history.back()"><b>Back</b></button>
					</center>
				</div>
			</div>
			</form> 

			</div>
		</div>
	</div>
</div>