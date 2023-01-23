<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i><?php echo $title;?>
							</div>
							
						</div>
						<div class="portlet-body">
								<?php
								$style="style='display:none;'";
								if($this->session->userdata("user_group_id")=="1"){    
								    $style="";
								}
								?>
								<form action="" method="post" class="form-horizontal" enctype='multipart/form-data' <?php echo $style; ?>>
												<div class="form-body">
												    <?php
													
													$post=$this->input->post();
													$branch_id ="";
													
													if($this->input->post()):
													    $branch_id =$post["branch_id"];
													    
													endif;
												    ?>
													<div class="form-group" >
														<label class="col-md-3 control-label">Branch Name</label>
														<div class="col-md-4">
															<?php
																echo form_dropdown("branch_id",$branch,$branch_id,"class='form-control'");
															?>
														</div>
													</div>
												</div>
												<div class="form-actions fluid">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn blue">Search</button>
														<a href="<?php echo site_url($this->uri->segment(1)); ?>"><button type="button" class="btn default">Clear</button></a>
													</div>
												</div>
								</form>
								
							<div class="table-toolbar">
								<div class="btn-group">
									<!--<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_treatment/add");?>'">
									Add New <i class="fa fa-plus"></i>
									</button>-->
								</div>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">Print</a>
										</li>
										<li>
											<a href="#">Save as PDF</a>
										</li>
										<li>
											<a href="#">Export to Excel</a>
										</li>
									</ul>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
								<tr>
									<th>No</th>
									<th>Treatment Name</th>
									<th>Description</th>
									<th>Image</th>
									<th>Duration</th>
									<th>Price</th>
									<th>Config</th>
									
								</tr>
							</thead>
							<tbody>
							<?php
								if($this->session->userdata("user_group_id")==1&&$branch_id==""){
												?>
												<tr class="odd gradeX">
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													
												</td>

												</tr>
												<?php
								}
								else{
												
								
								$no=1;
								foreach($get_data as $row){
							?>
							<tr class="odd gradeX">
								<td>
									<?php
										echo $no;
									?>
								</td>
								
								<td>
									<?php echo $row["treatment_name"];?>
								</td>
								<td>
									<?php echo $row["treatment_desc"];?>
								</td>
								<td>
									<img height="100px" src="<?php echo base_url();?>media/treatment/low/<?php echo $row["treatment_image"];?>">
								</td>
								<td>
									<?php echo $row["treatment_duration"];?> Menit
								</td>
								<?php
									if(empty($row["menu"])):
									?>
										<td>
											0
										</td>
										<td>
											<a href="<?php echo site_url("admin_treatment_price/add/".$row["treatment_id"]."");?>">Config</a>
										</td>		
									<?php
									else:
									?>
										<td>
											<?php echo $row["menu"][0]["treatment_price"];?>
										</td>
										<td>
											<a href="<?php echo site_url("admin_treatment_price/edit/".$row["menu"][0]["treatment_price_id"]."");?>">Config</a>
										</td>		
									
									<?php
									endif;
								?>

							</tr>
							<?php
								$no++;
								}
								}
							?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->