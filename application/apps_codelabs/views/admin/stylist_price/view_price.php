<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i><?php echo $title;?>
							</div>
							
						</div>
                                                <div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
								<?php
									//print_r($get_data);
									$row=$data[0];
									$id=$row["stylist_id"];
								?>
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" disabled="disabled" name="stylist_name" value="<?php echo $row["stylist_name"]; ?>" placeholder="Stylist Name" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Desc</label>
									<div class="col-md-4">
										<textarea class="form-control" name="stylist_desc" disabled="disabled" placeholder="Stylist Description" required><?php echo $row["stylist_desc"]; ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Phone</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="stylist_phone" disabled="disabled" value="<?php echo $row["stylist_phone"]; ?>" placeholder="Stylist Phone" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Stylist Photo</label>
									<div class="col-md-4">
										<img src="<?php echo base_url("media/stylist/low/".$row["stylist_photo"]."");;?>" width="200px">
										
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label">Branch</label>
									<div class="col-md-4">
										<?php
											echo form_dropdown("branch_id",$branch,$row["branch_id"],"disabled='disabled' class='form-control' required");
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-4">
										<button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"> Back </button>
									</div>
								</div>
								
							</div>
							
							
						</form>
						<!-- END FORM-->
					</div>
						<div class="portlet-body">
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
									<th>Skill</th>
									<th>Price</th>
                                                                        
									<th>Config</th>
									
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
									<?php echo $row["treatment_name"];?>
								</td>
								<td>
									<?php echo $row["treatment_desc"];?>
								</td>
								<td>
									<img height="100px" src="<?php echo base_url();?>media/treatment/low/<?php echo $row["treatment_image"];?>">
								</td>

								<?php
									if(empty($row["menu"])):
									?>
                                                                                <td>
                                                                                        -
                                                                                </td>
										<td>
											0
										</td>
										<td>
											<a href="<?php echo site_url("admin_stylist_price/add/".$row["treatment_id"]."/".$id);?>" class="btn green">Config</a>
										</td>		
									<?php
									else:
									?>
                                                                                <td>
                                                                                        <?php echo $row["menu"][0]["stylist_level_name"];?>
                                                                                </td>                                                                        
										<td>
											<?php echo $row["menu"][0]["stylist_price"];?>
										</td>
										<td>
											<a href="<?php echo site_url("admin_stylist_price/edit/".$row["treatment_id"]."/".$id);?>" class="btn green" >Config</a>
										</td>		
									
									<?php
									endif;
								?>

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