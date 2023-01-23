<?php //print_r($data);?>
<script>
	$(document).ready(function(){
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
		<form class="form-horizontal" action="<?php echo site_url("config/admin_page") ?>" method="post" enctype='multipart/form-data'>
			<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Web Title</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="web_title" placeholder="web_title" value="<?php echo $data[0]["web_title"];?>" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Web Name</label>
									<div class="col-md-4">
										<textarea class="form-control" name="web_name" placeholder="" value="" required><?php echo $data[0]["web_name"];?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Web Url</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="web_url" placeholder="web_url" value="<?php echo $data[0]["web_url"];?>" required>
									</div>
								</div>
								
								
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Logo</label>
									<div class="col-md-4">
										
                                                                                <img src="<?php echo base_url("media/config/".$data[0]["logo"]);?>"  height="50px">
                                                                                <input type="hidden" name="photo_status" id="photo_status" value="0">
                                                                                <input type="button" value="Change Photo" class="button blue-gradient" id="photo">
                                                                                <p class="button-height inline-label pt" style="display:none">
                                                                                        <?php
                                                                                                echo form_upload("logo","","id='photos'");
                                                                                        ?>
                                                                                </p>
                                                                        </div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Footer Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="footer_desc" placeholder="footer_desc" value="" required><?php echo $data[0]["footer_desc"];?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Web Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="web_desc" placeholder="web_desc" value="" required><?php echo $data[0]["web_desc"];?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Type Colom for content frontend</label>
									<div class="col-md-4">
										<?php
											$type=array("home_1"=>"two colom","home_2"=>"three colom");
                                                                                        echo form_dropdown("type",$type,$data[0]["type"],"required id='group'");
                                                                                ?>
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