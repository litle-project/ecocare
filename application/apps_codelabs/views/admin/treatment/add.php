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
						<form action="<?php echo site_url("admin_treatment/add");?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Code</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="treatment_code" placeholder="Treatment Code" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="treatment_name" placeholder="Treatment Name" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="treatment_desc" placeholder="Treatment Description" required></textarea>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Category</label>
									<div class="col-md-4">
										<?php
											echo form_dropdown("treatment_category_id",$treatment_category,"",'class="form-control" required');
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Image</label>
									<div class="col-md-4">
										<?php
											echo form_upload("treatment_image","","class='form-control'");
										?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Duration</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="treatment_duration" placeholder="Treatment Duration" required>
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