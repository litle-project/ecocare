<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datepicker/date_picker.css">
<script>
    $(document).ready(function () {
        $('table.display').dataTable();
    });
</script>



<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Return Barang</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/><br/>
		<div class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<div class="col-md-10">
						<label class="col-md-6 control-label"><b>Contract No :</b></label>
						<label class="control-label"><?php echo $data[0]['contract_no']; ?></label>
					</div>
				</div>
				<?php $date = date("l d-m-Y", strtotime($data[0]['schedule_date'])) ?>
                <div class="form-group">
					<div class="col-md-10">
						<label class="col-md-6 control-label"><b>Terminate Date :</b></label>
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
			</div>
		</div>
		<div class="row">
			<h3 style="padding-top:0;">PRODUCT</h3>
			<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
				<div class="portlet box grey">
					<div class="portlet-body">										
						<table class="table table-striped table-bordered table-hover display">
							<thead>
								<tr>
									<th>No</th>
									<th>Check</th>
									<th>Product Code</th>
									<th>Product Name</th>
									<th>Product Category</th>
									<th>Branch</th>
									<th>Gudang</th>
									<th>Return Quantity</th>
									<th>Lost</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="selected_only">
							<?php
								$no=1;
								for($i=0; $i <count($product) ; $i++){
							?>
								<tr class="gradeX">
								<form action="<?php echo base_url("return_barang/return_product/".$product[$i]['contract_schedule_detail_id']."");?>" method="post" autocomplete="off">

									<td><?php echo $no;?></td>
									<td>
										<input type="hidden" name="contract_id" value="<?php echo $data[0]['contract_id']?>">
										<input type="hidden" name="schedule_date" value="<?php echo $data[0]['schedule_date']?>">
										<input type="hidden" name="schedule_type" value="<?php echo $data[0]['schedule_type']?>">
										<input type="hidden" name="contract_schedule_id" value="<?php echo $data[0]['contract_schedule_id']?>">
										<input type="checkbox" name="product_id" value='<?php echo $product[$i]["product_id"];?>' onchange="input_price2(this)">
									</td>
									<td><?php echo $product[$i]["product_code"];?></td>
									<td><?php echo $product[$i]["product_name"];?></td>
									<td><?php echo $product[$i]["category_name"];?></td>
									<td>
										<select class="form-control" name="branch_id" id="branch_id1<?php echo $product[$i]["product_id"]; ?>" required disabled>
											<option value="">-- Please Select --</option>
											<?php foreach ($branch as $row) { ?>
												<option value="<?php echo $row['branch_id']?>"><?php echo $row['branch_name']?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<select class="form-control" name="gudang_id" id="gudang_id1<?php echo $product[$i]["product_id"]; ?>" required disabled>
											<option value="">-- Please Select --</option>
										</select>
									</td>
									<td>
										<input type="number" min="0" max="<?php echo $product[$i]['product_qty']?>" name="product_qty" class="form-control" id="product1<?php echo $product[$i]["product_id"]; ?>" value="<?php echo $product[$i]['product_qty']?>" required disabled>
									</td>
									<td>
										<input type="number" max="<?php echo $product[$i]['product_qty']?>" min="0" name="lost_qty" disabled id="lost1<?php echo $product[$i]["product_id"]; ?>" class="form-control">
									</td>
									<td>
										<?php if($product[$i]['category_id'] == '1'){
											if(!empty($product[$i]['return'])){ ?>
												<button type="submit" disabled class="btn btn-sm blue"><b>Return</b></button>
											<?php }else{ ?>
												<button type="submit" class="btn btn-sm blue"><b>Return</b></button>
											<?php } ?>
										<?php }else{ ?>
											<span class="btn btn-sm blue" onclick="warning()"><b>Return</b></span>
										<?php }?>
									</td>
							</form>
								</tr>
							<?php $no++; } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h3 style="padding-top:0;">PACKAGE</h3>
			<div class="col-lg-12 col-md-12 col-sm-12" style="padding-top: 20px;">
				<div class="portlet box grey">
					<div class="portlet-body">										
						<table class="table table-striped table-bordered table-hover display">
							<thead>
								<tr>
									<th>No</th>
									<th>Check</th>
									<th>Package Name</th>
									<th>Gudang</th>
									<th>Number Of Product Complaint</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="selected_only">
							<?php
								$no=1;
								for($i=0; $i <count($package) ; $i++){
							?>
								<tr class="gradeX">
								<form action="<?php echo base_url("return_barang/detail_package/".$package[$i]['contract_schedule_id']."");?>" method="post" autocomplete="off">
									<td><?php echo $no;?></td>
									<td>
										<input type="hidden" name="schedule_type" value="<?php echo $data[0]['schedule_type']?>">
										<input type="hidden" name="contract_id" value="<?php echo $data[0]['contract_id']?>">
										<input type="checkbox" name="package_id" value='<?php echo $package[$i]["package_id"];?>' onchange="input_price(this)">
									</td>
									<td><?php echo $package[$i]["package_name"];?></td>
									<td>Please Go To Return Button To Return Package</td>
									<td><?php echo $package[$i]['package_qty']?></td>
									<td><button type="submit" class="btn btn-sm blue" disabled id="return<?php echo $package[$i]['package_id']?>">Return</button></td>
							</form>
								</tr>
							<?php $no++; } ?>
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions fluid col-md-12">
			<center>
				<input type="hidden" name="ammend" id="ammendvalue">
				<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
			</center>
		</div>
	</div>
</div>

<!-- validate not aroma -->
<script type="text/javascript">
	function warning() {
				alert("Sorry This Product Can't Returned By System Because This Product Is Material!");
			}		
</script>

<script>
	<?php for ($i=0; $i<count($product); $i++) { ?>
		$('#branch_id1<?php echo $product[$i]['product_id']?>').change(function() {
				var branch1 =  $('#branch_id1<?php echo $product[$i]['product_id']?>').val();
					// alert(branch1);
					$.ajax({
				    type: "json",
				    url: "<?php echo base_url().'return_barang/cek_gudang/'?>"+branch1,
				    success: function(response){ 
			    		$('#gudang_id1<?php echo $product[$i]['product_id']?>').empty().append(response);
					},
				    error: function(){
				    	alert('Please Create Warehouse Before');
				   	}
			   }); 

			});
	<?php } ?>
</script>

<script>
	<?php for ($i=0; $i<count($product); $i++) { ?>
		$('#gudang_id1<?php echo $product[$i]['product_id']?>').change(function() {
				var gudang_id1 =  $('#gudang_id1<?php echo $product[$i]['product_id']?>').val();
				var branch_id1 =  $('#branch_id1<?php echo $product[$i]['product_id']?>').val();
				var product1   =  ('<?php echo $product[$i]['product_id']?>');
					// alert(gudang_id1);
					$.ajax({
				    type: "json",
				    url: "<?php echo base_url().'return_barang/validate_gudang_terminate/'?>"+branch_id1+"/"+gudang_id1+"/"+product1,
				    success: function(response){ 
			    		$('#product1<?php echo $product[$i]["product_id"]; ?>').empty().append(response);
					},
				    error: function(){
				    	alert('Please Create Warehouse Before');
				   	}
			   }); 

			});
	<?php } ?>
</script>

<script>
	function input_price2(checkbox_value2) {
		if(checkbox_value2.checked) {
			// alert(checkbox_value2.value);
			$('#product1'+checkbox_value2.value).removeAttr('disabled');
			$('#gudang_id1'+checkbox_value2.value).removeAttr('disabled');
			$('#branch_id1'+checkbox_value2.value).removeAttr('disabled');
			$('#lost1'+checkbox_value2.value).removeAttr('disabled');
		}else{
			$('#product1'+checkbox_value2.value).attr('disabled','disabled');
			$('#gudang_id1'+checkbox_value2.value).attr('disabled','disabled');
			$('#branch_id1'+checkbox_value2.value).attr('disabled','disabled');
			$('#lost1'+checkbox_value2.value).attr('disabled','disabled');
		}
	}

	function input_price(checkbox_value2) {
			if(checkbox_value2.checked) {
				// alert(checkbox_value2.value);
				$('#return'+checkbox_value2.value).removeAttr('disabled');
			}else{
				$('#return'+checkbox_value2.value).attr('disabled','disabled');
			}
		}
</script>