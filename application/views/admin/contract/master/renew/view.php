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
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Contract</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/><br/>
		<form action="<?php echo base_url('contract_master/renew/'.$data[0]['contract_id']."");?>" autocomplete="off" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<div class="row">
				<div class="form-body col-md-6">
					<div class="form-group">
                        <label class="control-label col-md-2">Contract No.
	                        <span class="required">
	                            *
	                        </span>
                        </label>
                        <div class="col-md-10">
							<input type="text" placeholder="Eg: Contract No 20" name="contract_no" value="<?php echo $data[0]['contract_no']?>" class="form-control" id="contract_no" required>
                        	<span id="test"></span>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-2">Branch
                        <span class="required">
                            *
                        </span>
                        </label>
                        <div class="col-md-10">
                            <select class="form-control" name="branch_id" required>
                            	<option value="">---- Please Select ----</option>
                            	<?php foreach ($branch as $cabang) { ?>
	                            	<option <?php if($data[0]['branch_id'] == $cabang['branch_id']){ echo "selected"; }?> value="<?php echo $cabang['branch_id']?>"><?php echo $cabang['branch_name'];?></option>
                            	<?php } ?>
                            </select>
						</div>
                    </div>
                    <?php $date = date("d-m-Y", strtotime($data[0]['contract_date'])); ?>
                    <div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Contract Date</label>
						<div class="col-md-10 col-sm-10">
							<div class="input-group date form_datetime">
								<input id="datepicker1" value="<?php echo $date;?>" width="442" name="contract_date" class="form-control" placeholder="Select Contract Date" readonly required /> 
	                		</div>
						</div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-2">Contract Purpose
                        </label>
                        <div class="col-md-10">
                            <select name="contract_purpose" class="form-control" required>
								<?php if ($data[0]['contract_purpose'] == 1){ ?>
									<option value="">---- Please Select ----</option>
									<option value="1" selected>Install</option>
									<option value="6">Trial</option>
									<option value="7">DO</option>
								<?php }elseif ($data[0]['contract_purpose'] == 6) { ?>
									<option value="">---- Please Select ----</option>
									<option value="1">Install</option>
									<option value="6" selected>Trial</option>
									<option value="7">DO</option>
								<?php }elseif($data[0]['contract_purpose'] == 7){ ?>
									<option value="">---- Please Select ----</option>
									<option value="1">Install</option>
									<option value="6">Trial</option>
									<option value="7" selected>DO</option>
								<?php } ?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Customer
                        </label>
                        <div class="col-md-10">
                           	<select class="form-control" name="customer_id" id="customer" required>
                           		<option value="">---- Please Select ----</option>
                           		<?php foreach ($customer as $cust) { ?>
	                           		<option <?php if($data[0]['customer_id'] == $cust['customer_id']){ echo "selected"; }?> value="<?php echo $cust['customer_id'];?>"><?php echo $cust['customer_name']?></option>
                           		<?php } ?>
                           	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Customer Address
                        </label>
                        <div class="col-md-10">
                           	<select class="form-control" name="address_id" id="address">
                           		<option value="">---- Please Select ----</option>
                           	</select>
                        </div>
                    </div>
                    <div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Period</label>
						<div class="col-md-10 col-sm-10">
							<input type="number" value="<?php echo $data[0]['contract_period']?>" class="form-control" min="1" max="12" name="contract_period" placeholder="/bulan" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Term Of Payment</label>
						<div class="col-md-10 col-sm-10">
							<input type="number" value="<?php echo $data[0]['contract_payment']?>" class="form-control" min="1" max="12" name="contract_payment" placeholder=" x / year" required/>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6" style="padding-top: 20px;">					
                    <div class="form-group">
						<label class="col-md-2 control-label">Notes</label>
						<div class="col-md-10 col-sm-10">
							<textarea class="form-control ckeditor" name="contract_note"><?php echo $data[0]['contract_note']?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-6" style="padding-top: 20px;">
					<h3>Product</h3>
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
										<th>Number Of Product</th>
										<th>Product Price</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									for($i=0; $i <count($product) ; $i++){
								?>
									<tr class="gradeX">
										<td><?php echo $no;?></td>
										<?php
											$checked 	= false;
											$price 		= 0;
											$amount 	= 0;
											$disable 	= true;
											 foreach ($detail_product as $key) {
												if ($key['product_id'] == $product[$i]['product_id']) {
													$checked 	= true;
													$disable 	= false;
													$price 		= $key['price'];
													$amount 	= $key['amount'];
													break;
												}
											}
										?>
										<td>
											<input type="checkbox" name="product[]" <?php if($checked){ echo "checked"; }?> value='<?php echo $product[$i]["product_id"];?>' onchange="input_price(this)">
										</td>

										<td><?php echo $product[$i]["product_code"];?></td>
										<td><?php echo $product[$i]["product_name"];?></td>
										<td><?php echo $product[$i]["category_name"];?></td>
										<td>
											<input type="number" name="<?php echo "number_of_product".$product[$i]["product_id"]?>" class="form-control" id="<?php echo "number_of_product".$product[$i]["product_id"]?>" <?php if($disable){ echo "disabled"; }?> value="<?php if($amount){ echo $amount;}?>"/>
										</td>
										<td>
											<input type="number" name="<?php echo"price".$product[$i]["product_id"]?>" class="form-control" id="<?php echo "price".$product[$i]["product_id"]?>" <?php if($disable){ echo "disabled"; }?> value="<?php if($price){ echo $price;}?>"/>
										</td>
										<td><a class="btn btn-sm red" href="<?php echo base_url('contract_master/delete_product?product_id='.$product[$i]['product_id'].'&contract_id='.$data[0]['contract_id'].'');?>">Delete</a></td>
									</tr> 
								<?php $no++; }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-6" style="padding-top: 20px;">
					<h3>Package</h3>
					<div class="portlet box grey">
						<div class="portlet-body">										
							<table class="table table-striped table-bordered table-hover display">
								<thead>
									<tr>
										<th>No</th>
										<th>Check</th>
										<th>Package Name</th>
										<th>Package Price</th>
										<th>Number Of Package</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									for($i=0; $i <count($package) ; $i++){
								?>
									<tr class="gradeX">
										<td><?php echo $no;?></td>
										<?php
											$check 					= false;
											$product_package_qty 	= 0;
											$disable 				= true;
											 foreach ($detail_package as $row) {
											 	$price 		= $row['price'];
												if ($row['package_id'] == $package[$i]['package_id']) {
													$check 					= true;
													$disable 				= false;
													$product_package_qty 	= $row['product_package_qty'];
													break;
												}
											}
										?>
										<td><input type="checkbox" name="package[]" <?php if($check){echo "checked";}?> value='<?php echo $package[$i]["package_id"];?>' onchange="input_price2(this)"></td>
										<td><?php echo $package[$i]["package_name"];?></td>
										<td><input type="text" name="price[]" class="form-control" value="<?php echo $price; ?>"></td>
										<td>
											<input type="text" class="form-control" value="<?php if($product_package_qty){echo $product_package_qty;}?>" name="number_of_package<?php echo $package[$i]['package_id']?>" id="number_of_package<?php echo $package[$i]['package_id']?>" <?php if($disable){echo "disabled";}?> >
										</td>
										<td><a class="btn btn-sm red" href="<?php echo base_url("contract_master/delete_package?package_id=".$package[$i]['package_id']."&contract_id=".$data[0]['contract_id']."")?>">Delete</a></td>
									</tr> 
								<?php $no++; }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions fluid col-md-12">
				<center>
					<button type="submit" id="submit" class="btn green"><b>Submit</b></button>
					<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
				</center>
			</div>
		</form>
	</div>
</div>

<!-- DATEPICKER START -->
<script src="<?php echo base_url();?>assets/datepicker/datepicker.js" type="text/javascript"></script>

<script>
	$(document).ready(function () {
	    $('#datepicker1').datepicker({
	      uiLibrary: 'bootstrap',
	      format: 'dd-mm-yyyy',
	      iconsLibrary: 'fontawesome'
	    });
	});
</script>
<!-- END -->

<!-- validate contract -->
<script>
	$('#contract_no').change(function() {
			var contract =  $('#contract_no').val();
				// alert(country);
				$.ajax({
			    type: "post",
			    // dataType: 'json',
			    url: "<?php echo base_url().'contract_master/cek_contract/'?>",
			    data: {contract_no: contract},
			    success: function(response){ 
			    	// console.log(response);
		    		$('#test').empty().append(response);
				},
		   }); 

		});
</script>

<!-- get address cust -->
<script>
	$('#customer').change(function() {
			var member =  $('#customer').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'contract_master/get_address/'?>"+member,
			    success: function(response){ 
		    		$('#address').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Address For This Customer');
			   	}
		   }); 

		});
</script>

<!-- validate price -->
<script>
	function input_price(checkbox_value) {
		if(checkbox_value.checked) {
			// alert(checkbox_value.value);
			$('#price'+checkbox_value.value).removeAttr('disabled');
			$('#number_of_product'+checkbox_value.value).removeAttr('disabled');
		}else{
			$('#price'+checkbox_value.value).attr('disabled','disabled');
			$('#number_of_product'+checkbox_value.value).attr('disabled','disabled');	
		}
	}
	function input_price2(checkbox_value2) {
		if(checkbox_value2.checked) {
			// alert(checkbox_value2.value);
			$('#price2'+checkbox_value2.value).removeAttr('disabled');
			$('#number_of_package'+checkbox_value2.value).removeAttr('disabled');
		}else{
			$('#price2'+checkbox_value2.value).attr('disabled','disabled');
			$('#number_of_package'+checkbox_value2.value).attr('disabled','disabled');	
		}
	}
</script>