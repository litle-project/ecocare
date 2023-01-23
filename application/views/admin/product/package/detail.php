<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="col-lg-7 col-md-7 col-sm-7">
            <h1><?php echo $title;?></h1>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5">
            <ul class="breadcrumb pull-right">
                <li>
                    <a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Package</a>
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
        		<div class="form-group">
                	<label class="col-md-4 col-sm-3 control-label"><b>Package Name : </b></label>
               		<label class="control-label"><?php echo $data[0]['package_name']; ?></label>
               	</div>
               	<div class="form-group">
                	<label class="col-md-4 col-sm-3 control-label"><b>Package Desc : </b></label>
               		<label class="control-label"><?php echo $data[0]['package_desc']; ?></label>
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
											<th>Product Quantity</th>
											<th>Total Per Install</th>
											<th>Total Per Service</th>
											<th>Service Period</th>
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
											<td><?php echo $product[$i]["product_qty"];?></td>
											<td><?php echo $product[$i]["total_per_install"];?></td>
											<td><?php echo $product[$i]["total_per_service"];?></td>
											<td><?php echo $product[$i]["service_period"];?></td>
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
	                        <button type="button" class="btn default" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'"><b>Back</b></button>
	                    </center>
	                </div>
	            </div>
            </form>

            </div>
        </div>
    </div>
</div>