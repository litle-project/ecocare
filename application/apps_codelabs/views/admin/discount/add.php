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
						<form action="<?php echo site_url("admin_discount/add");?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
							
								<div class="form-group">
									<label class="col-md-3 control-label">Day</label>
									<div class="col-md-6">
										<?php
											$vday=1;
											if($this->uri->segment(3)){
												$vday=$this->uri->segment(3);
											}
											echo form_dropdown("day",$day,$vday,'class="form-control" id="day" required');
										?>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label">Discount Set</label>
									<div class="col-md-6">
										<table class="table table-striped table-bordered" >
										<thead>
											<tr>
												<th>Treatment</th>
												<th>Price</th>
												<th>Discount</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$row=$get_treatment_price;
												for($i=0; $i<count($row); $i++){
											?>
											<tr>
												<td>
													<?php echo $row[$i]["treatment_name"];?>
												</td>
												<td><?php echo $row[$i]["treatment_price"];?></td>
												<td>
													<?php 
														$val ="";
														if(isset($get_discount[$row[$i]["treatment_id"]])){
															$val = $get_discount[$row[$i]["treatment_id"]];
														}
														
														echo form_input("disc[".$row[$i]["treatment_id"]."]",$val);
														
													?>
												</td>
											</tr>
											<?php
												}
											?>
										</tbody>
										</table>
										
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
<script>
$(document).ready(function() {
	$("#day").change(function() {
		var a = $(this).val();
		
		window.location.href="<?php echo site_url("admin_discount/add")?>/"+a;
		
	});
});
</script>