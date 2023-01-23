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
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-6" style="padding-top: 20px;">
					<h3>Package</h3>
						<div class="portlet box grey">
							<div class="portlet-body">										
								<table class="table table-striped table-bordered table-hover display">
									<thead>
										<tr>
											<th>No</th>
											<th>Product Name</th>
											<th>Product Category</th>
											<th>Request <?php if($schedule='1'){ echo "Install"; }elseif($schedule='2'){ echo "Service"; }?></th>
											<th>Product Qty</th>
											<th>Service Period</th>
										</tr>
									</thead>
									<tbody>
									<?php
										date_default_timezone_set('Asia/Jakarta');
										$date1 = $data[0]['contract_date'];
								        $date2 = $data[0]['schedule_date'];
								        $ts1 = strtotime($date1);
								        $ts2 = strtotime($date2);
								        $year1 = date('Y', $ts1);
								        $year2 = date('Y', $ts2);
								        $month1 = date('m', $ts1);
								        $month2 = date('m', $ts2);
								        $date = (($year2 - $year1) * 12) + ($month2 - $month1);
										for($i=0; $i <count($package) ; $i++){
										$no=1;
											if($schedule == 2 && $package[$i]['service_period'] == $data[0]['month'] || $package[$i]['service_period'] == 1){ ?>
												<tr class="gradeX">
													<td><?php echo $no;?></td>
													<td><?php echo $package[$i]["product_name"];?></td>
													<td><?php echo $package[$i]["category_name"];?></td>
													<td><?php if($schedule='1'){ echo $package[$i]['total_per_install']; }elseif($schedule='2'){ echo $package[$i]['total_per_service']; }?></td>
													<td><?php echo $package[$i]['product_qty']?></td>
													<td><?php echo $package[$i]['service_period']; ?></td>
												</tr>
											<?php }elseif($schedule == 1){ // if install then this data ?> 
												<tr class="gradeX">
													<td><?php echo $no;?></td>
													<td><?php echo $package[$i]["product_name"];?></td>
													<td><?php echo $package[$i]["category_name"];?></td>
													<td><?php if($schedule='1'){ echo $package[$i]['total_per_install']; }elseif($schedule='2'){ echo $package[$i]['total_per_service']; }?></td>
													<td><?php echo $package[$i]['product_qty']?></td>
													<td><?php echo $package[$i]['service_period']; ?></td>
												</tr>
										<?php }$no++;}?>
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