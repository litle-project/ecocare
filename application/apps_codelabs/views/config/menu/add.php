<?php //print_r($data);?>

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
		<form class="form-horizontal" action="<?php echo site_url("config/menu_add") ?>" method="post">
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Menu Name</label>
									<div class="col-md-4">
										<textarea class="form-control" name="menu_name" placeholder="index_id" value="" required></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu Description</label>
									<div class="col-md-4">
										<textarea class="form-control" name="menu_desc" placeholder="title" value=""></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Group Menu</label>
									<div class="col-md-4">
										<?php
                                                                                        echo form_dropdown("group_menu_id",$group,"","required id='group'");
                                                                                ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu URL</label>
									<div class="col-md-4">
										<textarea class="form-control" name="menu_url" placeholder="menu_url" value="" required></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu View</label>
									<div class="col-md-4">
										<input type="checkbox" checked="checked" name="menu_view" disabled="disabled" value="1">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu Add</label>
									<div class="col-md-4">
										<input type="checkbox"	name="menu_add" value="1">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu Edit</label>
									<div class="col-md-4">
										<input type="checkbox"	name="menu_edit" value="1">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu Delete</label>
									<div class="col-md-4">
										<input type="checkbox"	name="menu_delete" value="1">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Menu Other</label>
									<div class="col-md-4">
										<input type="checkbox"	name="menu_other" value="1">
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