<?php
	$row=$user_group[0];
?>


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
		<form class="form-horizontal" action="<?php echo site_url("admin_privileges/edit/".$this->uri->segment(3)) ?>" method="post">
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">User Privileges Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="priv_name" placeholder="News Title" value="<?php echo $row["user_group_name"];?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">User Privileges Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="priv_desc" placeholder="News Desc" required><?php echo $row["user_group_desc"];?></textarea>
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
	</div>
				</div>
			</div>
		</div>
	</div>
</div>				