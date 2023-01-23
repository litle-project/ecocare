<div class="row">
	<div class="col-md-12">
		<div class="tab-content">
			<div class="tab-pane active" id="tab_0">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i><?php echo $title;?>
						</div>
						
					</div>
					<div class="portlet-body form">
		<form class="form-horizontal" action="<?php echo site_url("config/group_edit") ?>" method="post">
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Group Menu Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="group_menu_name" placeholder="group_menu_name" value="<?php echo $data[0]["group_menu_name"]; ?>" required>
										<input type="hidden" class="form-control" name="group_menu_id" placeholder="group_menu_id" value="<?php echo $data[0]["group_menu_id"]; ?>" required>
									
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Group Menu Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="group_menu_desc" placeholder="group_menu_desc" value="" required><?php echo $data[0]["group_menu_desc"]; ?></textarea>
									</div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url("admin_privileges");?>'">Cancel</button>
								</div>
							</div>

		</form>
	</div>
				</div>
			</div>
		</div>
	</div>
</div>							