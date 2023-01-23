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
					<?php
						
						$row=$get_data[0];
					?>
					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="name" disabled="disabled" value="<?php echo $row["treatment_name"];?>" placeholder="Treatment Name" required>
										<input type="hidden" class="form-control" name="treatment_name" value="<?php echo $row["treatment_name"];?>" placeholder="Treatment Name" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="treatment_desc" disabled="disabled" placeholder="Treatment Description" required><?php echo $row["treatment_desc"];?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Image</label>
									<div class="col-md-4">
										<img src="<?php echo base_url("media/treatment/low/".$row["treatment_image"]."");;?>" width="200px">
										
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Duration</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="treatment_duration" disabled="disabled" value="<?php echo $row["treatment_duration"];?>" placeholder="Treatment Duration" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Price</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="treatment_price" value="" placeholder="Treatment Price" required>
										<?php
										if($this->session->userdata("user_group_id")>1):
										?>
											<input type="hidden" class="form-control" name="branch_id" value="<?php echo $this->session->userdata("branch_id"); ?>" placeholder="Branch ID" required>
										<?php
										else:
										?>
											<input type="hidden" class="form-control" name="branch_id" value="<?php echo $row["menu"][0]["branch_id"];?>" placeholder="Branch ID" required>
										<?php
										endif;
										?>
										
										<input type="hidden" class="form-control" name="treatment_id" value="<?php echo $row["treatment_id"];?>" placeholder="Branch ID" required>
									</div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Submit</button>
									<button type="reset" class="btn red"  id="reset">Reset</button>
									<br>
									<br>
									<button type="button" class="btn yellow" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
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

