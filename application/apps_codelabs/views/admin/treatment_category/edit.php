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
									<label class="col-md-3 control-label">Treatment Category Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="treatment_category_name" value="<?php echo $row["treatment_category_name"];?>" placeholder="Treatment Name" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Treatment Category Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="treatment_category_desc" placeholder="Treatment Description" required><?php echo $row["treatment_category_desc"];?></textarea>
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