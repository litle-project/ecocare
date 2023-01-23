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
									<button class="btn green" onclick="window.location.href='<?php echo site_url("admin_stylist/add");?>'">
									Add New <i class="fa fa-plus"></i>
									</button>
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
									<th>Stylist Name</th>
									<th>Stylist photo</th>
									<th>Stylist phone</th>
									<th>Description</th>
									<th>Branch</th>
									<th>Edit</th>
									
								</tr>
							</thead>
							<tbody>
							<?php
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
									<?php echo $row["stylist_name"];?>
								</td>
								<td>
									<img height="50px" src="<?php echo base_url();?>media/stylist/low/<?php echo $row["stylist_photo"];?>">
								</td>
								<td>
									<?php echo $row["stylist_phone"];?>
								</td>
								<td>
									<?php echo $row["stylist_desc"];?>
								</td>
								<td>
									<?php echo $row["branch_name"];?>
								</td>
								<td>
									<a href="<?php echo site_url("admin_stylist_price/view/".$row["stylist_id"]."");?>" class="btn green">Detail</a>
								</td>
								
							</tr>
							<?php
								$no++;
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