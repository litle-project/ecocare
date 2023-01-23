<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Product</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/>
		<div class="portlet box grey">
			<div class="portlet-body form">
				<br/>

			<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
				<div class="form-body">
					<?php $date = date("l d-m-Y", strtotime($data[0]['schedule_date'])) ?>
                    <div class="form-group">
						<div class="col-md-10">
							<label class="col-md-6 control-label"><b>Complaint Date :</b></label>
							<label class="control-label"><?php echo $date; ?></label>
						</div>
					</div>
					<?php foreach($teknisi as $row){ ?>
						<div class="form-group">
							<div class="col-md-10">
								<label class="col-md-6 control-label"><b>Teknisi :</b></label>
								<label class="control-label"><?php echo $row['teknisi_name']?></label>
							</div>
						</div>
					<?php } ?>
					<div class="form-group">
						<div class="col-md-10">
							<label class="col-md-6 control-label"><b>Reason Complaint :</b></label>
							<?php if ($data[0]['reason'] == '1') { ?>
								<label class="control-label"><?php echo "Unit Damage / Not Working"; ?></label>
							<?php }else{ ?>
								<label class="control-label"><?php echo "Less Material"; ?></label>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10">
							<label class="col-md-6 control-label"><b>Complaint Note :</b></label>
							<label class="control-label"><?php echo $data[0]['note']; ?></label>
						</div>
					</div>
					<div class="row">
						<?php if(!empty($product)) { ?>
						<h3 style="padding-top:0;">PRODUCT</h3>
						<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
							<div class="portlet box grey">
								<div class="portlet-body">										
									<table class="table table-striped table-bordered table-hover display">
										<thead>
											<tr>
												<th>No</th>
												<th>Product Code</th>
												<th>Product Name</th>
												<th>Product Category</th>
												<th>Number Of Product Complaint</th>
											</tr>
										</thead>
										<tbody class="selected_only">
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
											</tr>
										<?php $no++; } ?>
										</tbody>
										
									</table>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
						</center>
					</div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>
<!-- show and hide product aroma -->
<script>
	$(document).ready(function(){
        $('#category').on('change', function() {
          if ( this.value == '2')
          {
            $("#aroma").show();
          }
          else
          {
            $("#aroma").hide();
          }
        });
    });

    $(document).ready(function(){
        $('#product_aroma').on('change', function() {
          if ( this.value == '1')
          {
            $("#aroma_name").show();
            $("#addRow2-1").show();
          }
          else
          {
            $("#aroma_name").hide();
            $("#addRow2-1").hide();
          }
        });
    });
</script>

<!-- end -->