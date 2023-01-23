<div class="row">
	<div class="col-md-12">
		<div class="tab-sliding">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i><?php echo $title;?>
						</div>
						
					</div>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="branch_name" placeholder="Branch Name" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">City Name</label>
									<div class="col-md-4">
										<?php
											echo form_dropdown("city_id",$city,"","class='form-control' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Image</label>
									<div class="col-md-4">
										<?php
											echo form_upload("branch_image","","class='form-control' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Address</label>
									<div class="col-md-4">
										<?php
											echo form_textarea("branch_address","","class='form-control' placeholder='Branch Address' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Phone</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_phone","","class='form-control' placeholder='Branch Phone' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Longitude</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_long","","class='form-control' placeholder='Branch Longitude' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Latitude</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_lat","","class='form-control' placeholder='Branch Latitude' required");
										?>
									</div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>
									<button type="reset" class="btn red"  id="reset">Reset</button>
									<br>
									<br>
									<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
								</div>
							</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>				