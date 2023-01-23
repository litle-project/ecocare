<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="col-lg-7 col-md-7 col-sm-7">
            <h1><?php echo $title;?></h1>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">
            <ul class="breadcrumb pull-right">
                <li>
                    <a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Detail Service</a>
                </li>
                <li>
                    <span><?php echo $title;?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <br/>
        <div class="portlet box grey">
            <div class="portlet-body form">
            <br/>
            
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-body">
        	<?php 
        		if ($data[0]['schedule_type'] == 1) { 
        			for ($i=0; $i<count($installer); $i++) { ?>
                		<div class="form-group">
	                    	<label class="col-md-4 col-sm-3 control-label"><b>Installer Name : </b></label>
	                   		<label class="control-label"><?php echo $installer[$i]['teknisi_name']; ?></label>
	                   	</div>
        	<?php }}else{ 
        			for ($i=0; $i<count($teknisi); $i++) { ?>
                		<div class="form-group">
            				<label class="col-md-4 col-sm-3 control-label"><b>Teknisi Name  : </b></label>
	                  		<label class="control-label"><?php echo $teknisi[$i]['teknisi_name']; ?></label>
                		</div>
        	<?php }} ?>
                </div>
                <div class="form-group">
	                <label class="col-md-4 col-sm-3 control-label"><b>Schedule Type : </b></label>
	                   	<label class="control-label">
                			<?php 
                				if ($data[0]['schedule_type'] == 1) {
	                   				 echo "Install"; 
	                   			}elseif($data[0]['schedule_type'] == 2){
	                   			 	echo "Service"; 
	                   			}elseif ($data[0]['schedule_type'] == 3) {
	                   				echo "Termination";
	                   			}elseif($data[0]['schedule_type'] == 4){
	                   				echo "Complaint";
	                   			}elseif($data[0]['schedule_type'] == 5){
	                   				echo "Special Request";
	                   			}
	                   		?>
                   		</label>
                </div>
                <div class="form-group">
                	<label class="col-md-4 col-sm-3 control-label"><b>Schedule Date : </b></label>
               		<label class="control-label"><?php echo date("l d-m-Y", strtotime($data[0]['schedule_date'])); ?></label>
                </div>
                <!-- ///// -->
                <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-6" style="padding-top: 20px;">
					<h3>Product</h3>
						<div class="portlet box grey">
							<div class="portlet-body">										
								<table class="table table-striped table-bordered table-hover display">
									<thead>
										<tr>
											<th>No</th>
											<th>Product Code</th>
											<th>Product Name</th>
											<th>Product Category</th>
											<th>Total Product</th>
											<th>Product Price</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no=1;
										for($i=0; $i <count($product) ; $i++){
									?>
										<tr class="gradeX">
											<td><?php echo $no;?></td>
											<td><?php echo $product[$i]["product_code"];?></td>
											<td><?php echo $product[$i]["product_name"];?></td>
											<td><?php echo $product[$i]["category_name"];?></td>
											<td>
												<input type="number" name="<?php echo "number_of_product".$product[$i]["product_id"]?>" class="form-control" readonly id="<?php echo "number_of_product".$product[$i]["product_id"]?>" value="<?php echo $product[$i]['product_qty']?>"/>
											</td>
											<td>
												<input type="number" readonly name="<?php echo"price".$product[$i]["product_id"]?>" class="form-control" id="<?php echo "price".$product[$i]["product_id"]?>" value="<?php echo $product[$i]['price']?>"/>
											</td>
										</tr> 
									<?php $no++; }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- //// -->
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-6" style="padding-top: 20px;">
					<h3>Package</h3>
						<div class="portlet box grey">
							<div class="portlet-body">										
								<table class="table table-striped table-bordered table-hover display">
									<thead>
										<tr>
											<th>No</th>
											<th>Package Name</th>
											<th>Total Package</th>
											<th>Package Price</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no=1;
										for($i=0; $i <count($package) ; $i++){
									?>
										<tr class="gradeX">
											<td><?php echo $no;?></td>
											<td><?php echo $package[$i]["package_name"];?></td>
											<td>
												<input type="number" name="<?php echo "number_of_package".$package[$i]["package_id"]?>" class="form-control" readonly id="<?php echo "number_of_package".$package[$i]["package_id"]?>" value="<?php echo $package[$i]['package_qty']?>"/>
											</td>
											<td>
												<input type="number" readonly name="<?php echo"price".$package[$i]["package_id"]?>" class="form-control" id="<?php echo "package_price".$package[$i]["package_id"]?>" value="<?php echo $package[$i]['price']?>"/>
											</td>
											<td><a href="<?php echo base_url("schedule_master/detail_request?package_id=".$package[$i]['package_id']."&schedule_type=".$data[0]['schedule_type']."&contract_id=".$data[0]['contract_id']."&contract_schedule_id=".$data[0]['contract_schedule_id'])?>" class="btn btn-sm btn-fill btn-primary">Detail Request</a></td>
										</tr> 
									<?php $no++; }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            <div class="form-actions fluid">
                <div class="col-md-12">
                    <center>
                        <button type="button" class="btn default" onclick="window.history.back();"><b>Back</b></button>
                    </center>
                </div>
            </div>
            </form>

            </div>
        </div>
    </div>
</div>