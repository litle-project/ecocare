<?php
$row=$get_user[0];
?>
<script src="<?php echo base_url();?>template/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		<?php
			if($row["user_group_id"]>1):
			?>
				$("#res").fadeIn();
				$("#rest").attr("required","true");
			<?php
			endif;	
		?>
		//alert("a");
		$("#submit").click(function(){
			var ps1=$("#pass1").val();
			var ps2=$("#pass2").val();
                        var st = $("#pass_status").val();
			if (st==1) {
                            if(ps1==ps2){
                                    return true;
                            }else{
                                    alert("password not same");
                                    return false;
                            }
                        }

		});
		
		$("#pass").click(function(){
			var vala=$(this).attr("value");
			if(vala=="Change Password"){
				$(".ps1").fadeIn();
				$(this).val("Unchange Password");
				$("#pass1").attr("required",true);
				$("#pass2").attr("required",true);
				$("#pass_status").val("1");
			}else{
				$(".ps1").hide();
				$(this).val("Change Password");
				$("#pass1").attr("required",false);
				$("#pass2").attr("required",false);
				$("#pass_status").val("0");
			}
		});
		
		$("#photo").click(function(){
                        //alert("aaa");
			var vala=$(this).attr("value");
			if(vala=="Change Photo"){
				$(".pt").fadeIn();
				$(this).val("Unchange Photo");
				$("#photos").attr("required",true);
				$("#photo_status").val("1");
			}else{
				$(".pt").hide();
				$(this).val("Change Photo");
				$("#photos").attr("required",false);
				$("#photo_status").val("0");
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
		<form class="form-horizontal" action="<?php echo site_url("admin_user/edit/" . $row["admin_id"]) ?>" method="post" enctype='multipart/form-data'>
                
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Username</label>
									<div class="col-md-4">
										<?php
                                                                                        echo form_input("username",$row["admin_username"],"required class='input full-width'");
                                                                                ?>  
									</div>
								</div>
								
								<div class="form-group ps1" style="display:none">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_password("password1","","id='pass1' class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group ps1" style="display:none">
									<label class="col-md-3 control-label">Confirm Password</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_password("password2","","id='pass2' class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                <div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-4">
                                                                                <input type="hidden" name="pass_status" id="pass_status" value="0">
                                                                                <input type="button" value="Change Password" class="button blue-gradient" id="pass">
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Name</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_input("name",$row["admin_name"],"required class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Email</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_input("email",$row["admin_email"],"required class='input full-width'");
                                                                                ?>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Photo</label>
									<div class="col-md-4">
                                                                                <img src="<?php echo base_url("media/user/".$row["admin_photo"]);?>" width="150px" height="150px">
                                                                                <input type="hidden" name="photo_status" id="photo_status" value="0">
                                                                                <input type="button" value="Change Photo" class="button blue-gradient" id="photo">
                                                                                <p class="button-height inline-label pt" style="display:none">
                                                                                        <?php
                                                                                                echo form_upload("photo","","id='photos'");
                                                                                        ?>
                                                                                </p>
                                                                        </div>
								</div>
                                                                
                                                                <div class="form-group">
									<label class="col-md-3 control-label">User Group Privileges</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_dropdown("priv",$priv,$row["user_group_id"],"required id='priv'");
                                                                                ?>
                                                                        </div>
								</div>
								
								<div class="form-group" style="display:none" id="res">
									<label class="col-md-3 control-label">User For Branch</label>
									<div class="col-md-4">
                                                                                <?php
                                                                                        echo form_dropdown("branch_id",$branch,$row["branch_id"],"id='rest'");
                                                                                ?>
                                                                        </div>
								</div>
								
							</div>
							<div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue"  id="submit">Submit</button>
									<button type="reset" class="btn red" >Reset</button>
									
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