<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Customer</a>
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
				<form action="<?php echo base_url("customer_master/add");?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Customer Name (Brand)</label>
							<div class="col-md-8">
								<input type="text" name="customer_name" class="form-control" placeholder="Eg: PT Angkas Pura" required>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-md-3 control-label">Customer Name NPWP</label>
							<div class="col-md-8">
								<input type="text" name="customer_npwp" class="form-control" placeholder="NPWP Number of User PIC" required>
							</div>
						</div>														
						<div class="form-group">
							<label class="col-md-3 control-label">Customer Email</label>
							<div class="col-md-8">
								<input type="email" name="customer_email" class="form-control" placeholder="Eg: jhondoe@mail.com" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Customer Telp</label>
							<div class="col-md-8">
								<input type="text" name="customer_phone" class="form-control" placeholder="Eg: 021-927-xxx" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Customer PIC</label>
							<div class="col-md-8">
								<input type="text" name="customer_pic" class="form-control" placeholder="Type User PIC Here" required>
							</div>
						</div>
					</div>
					<div class="form-actions fluid">
						<div class="col-md-12">
							<center>
								<button type="submit" class="btn blue">Submit</button>&nbsp;&nbsp;&nbsp;
								<button type="reset" class="btn red"  id="reset">Reset</button>&nbsp;&nbsp;&nbsp;
								<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



		