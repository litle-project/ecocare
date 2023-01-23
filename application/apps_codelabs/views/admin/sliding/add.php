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
						<form action="<?php echo site_url("admin_sliding/add");?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Sliding Title</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="sliding_title" placeholder="Sliding Title" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Sliding Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="sliding_desc" placeholder="Sliding Desc" required></textarea>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Sliding Image</label>
									<div class="col-md-4">
										<input type="file" class="form-control" name="sliding_image" placeholder="Sliding Image">
									</div>
								</div>
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default">Cancel</button>
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