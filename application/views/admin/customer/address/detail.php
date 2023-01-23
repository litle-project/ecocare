<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Address</a>
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
			<form class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Customer Name :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['customer_name'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Customer Address :</b></label>
					<div class="col-md-6 col-sm-6">
						<label class="control-label"><?php echo $data[0]['address'];?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 col-sm-3 control-label"><b>Customer Location on Map :</b></label>
					<div class="col-md-6 col-sm-6">
						<fieldset class="gllpLatlonPicker">
							<br/>
							<div class="gllpMap">Google Maps</div>
							<br/>
								<input type="hidden" name="lat" class="gllpLatitude" value="<?php echo $data[0]['address_lat'];?>"/>
								<input type="hidden" name="long" class="gllpLongitude" value="<?php echo $data[0]['address_long'];?>"/>
								<input type="hidden" name="zoom" class="gllpZoom" value="<?php echo $data[0]['address_zoom'];?>"/>
						</fieldset>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
						</center>
					</div>	
				</div>
			</form>

			</div>
		</div>
	</div>
</div>

<!--  start jquery maps -->
<script src="<?php echo base_url();?>assets/gmap/jquery-2.1.1.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDNopaHfVPZ-wS_gwdyM3GmYWvTzKy-pT0"></script>
<!-- CSS and JS for our code -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/gmap/jquery-gmaps-latlon-picker.css"/>
<script src="<?php echo base_url();?>assets/gmap/jquery-gmaps-latlon-picker.js"></script>
<!-- end jquery maps -->