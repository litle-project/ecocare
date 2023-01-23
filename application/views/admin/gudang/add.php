<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Gudang</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	 <?php 
		 if(!empty($gudang_code[0]['code'])){
	        $number_queue = sprintf('%04d',$gudang_code[0]["code"]+1);
	    }else{
	        $number = 0;
    	    $number_queue = sprintf('%04d',$number+1);
       } ?>
	<div class="col-md-12 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>

				<form action="<?php echo base_url().$this->uri->segment(1); ?>/add" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Gudang Code</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" readonly name="gudang_code" class="form-control" value="GD-<?php echo $number_queue?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Gudang Name</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" name="gudang_name" class="form-control" placeholder="Eg: Warehouse Product" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Gudang Address</label>
						<div class="col-md-8">
							<textarea name="gudang_address" class="form-control" rows="5" placeholder="Detail Address Of Warehouse" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Gudang Location</label>
						<div class="col-md-8">
							<fieldset class="gllpLatlonPicker">
								<input type="text" placeholder="Search Gudang Location Here" class="gllpSearchField form-control">
								<!-- <br> -->
								<input type="button" class="gllpSearchButton btn btn-primary" value="search">
								<br/><br/>
								<div class="gllpMap">Google Maps</div>
								<br/>
									<input type="hidden" name="gudang_lat" class="gllpLatitude" value="-6.1864864"/>
									<input type="hidden" name="gudang_long" class="gllpLongitude" value="106.83409110000002"/>
									<input type="hidden" name="gudang_zoom" class="gllpZoom" value="12"/>
								<!-- <input type="button" class="gllpUpdateButton" value="update map"> -->
							</fieldset>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Branch</label>
						<div class="col-md-8">
							<select name="branch_id" class="form-control" required>
								<option value="">---- Please Select ----</option>
								<?php foreach ($branch as $key) { ?>
									<option value="<?php echo $key['branch_id']?>"><?php echo $key['branch_name']?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn green"><b>Submit</b></button>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
							<!--
							<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
							-->
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