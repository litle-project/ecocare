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
						
						<?php
							$row = $get_data[0];
						?>
						<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Name</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_name",$row["branch_name"],"class='form-control' placeholder='Branch Name' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">City Name</label>
									<div class="col-md-4">
										<?php
											echo form_dropdown("city_id",$city,$row["city_id"],"class='form-control' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Image</label>
									<div class="col-md-4">
										<img src="<?php echo base_url("media/branch/low/".$row["branch_image"]."");;?>" width="200px">
										<br>
										<br>
										
										<button type="button" class="btn green" id="photo">Change Image</button>
										
										<br>
										<br>
										<div class="pt" style="display:none">
										<?php
											echo form_upload("branch_image","","id='photos' class='form-control'");
										?>
										<input type="hidden" value="0" name="photo_status" id="photo_status">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Address</label>
									<div class="col-md-4">
										<?php
											echo form_textarea("branch_address",$row["branch_address"],"class='form-control' placeholder='Branch Address' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Phone</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_phone",$row["branch_phone"],"class='form-control' placeholder='Branch Phone' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Longitude</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_long",$row["branch_long"],"class='form-control' placeholder='Branch Longitude' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Branch Latitude</label>
									<div class="col-md-4">
										<?php
											echo form_input("branch_lat",$row["branch_lat"],"class='form-control' placeholder='Branch Latitude' required");
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

<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$("#photo").click(function(){
            
			//alert("aaa");
			var vala=$(this).html();
			//alert(vala);
			if(vala=="Change Image"){
				$(".pt").fadeIn();
				$(this).html("Unchange Image");
				$("#photos").attr("required",true);
				$("#photo_status").val("1");
			}else{
				$(".pt").hide();
				$(this).html("Change Image");
				$("#photos").attr("required",false);
				$("#photo_status").val("0");
			}
		});
	});
</script>