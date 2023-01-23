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
						<form action="<?php echo site_url("admin_stylist/add");?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="stylist_name" placeholder="Stylist Name" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="stylist_desc" placeholder="Stylist Description" required></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Phone</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="stylist_phone" placeholder="Stylist Phone" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Photo</label>
									<div class="col-md-4">
										<?php
											echo form_upload("stylist_photo","","class='form-control' required");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Branch</label>
									<div class="col-md-4">
										<?php
											echo form_dropdown("branch_id",$branch,"","class='form-control' required");
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