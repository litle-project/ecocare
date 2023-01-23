<script>
	$(document).ready(function(){
		
		//alert("a");
		$("#submit").click(function(){
			var ps1=$("#pass1").val();
			var ps2=$("#pass2").val();
			if(ps1==ps2){
				return true;
			}else{
				alert("password not same");
				return false;
			}
		});
		
		$("#priv").change(function(){
			//alert("a");
			var a=$(this).val();
			if(a>1){
				$("#res").fadeIn();
				$("#rest").attr("required","true");
				
			}else{
				$("#res").hide();
				$("#rest").val("");
				$("#rest").attr("required","false");				
			}
			
		});
        });
</script>

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
		<form class="form-horizontal" action="<?php echo site_url("admin_user/add") ?>" method="post" enctype='multipart/form-data'>
                
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Username</label>
									<div class="col-md-4">
										<?php
                                                                                        echo form_input("username","","required class='input full-width'");
                                                                                ?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_password("password1","","id='pass1' required class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Confirm Password</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_password("password2","","id='pass2' required class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Name</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_input("name","","required class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Email</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_input("email","","required class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Photo</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_upload("photo","","required");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">User Group Privileges</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_dropdown("priv",$priv,"","required id='priv'");
                                                                                ?>
                                                                        </div>
								</div>
								
								<div class="form-group" style="display:none" id="res">
									<label class="col-md-3 control-label">User For Branch</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_dropdown("branch_id",$branch,"","id='rest'");
                                                                                ?>
                                                                        </div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue"  id="submit">Submit</button>
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