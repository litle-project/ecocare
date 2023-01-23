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
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Assignment</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/><br/>
		<form action="<?php echo base_url('schedule_master/edit/'.$data[0]['contract_id']."");?>" autocomplete="off" method="post" class="form-horizontal" enctype='multipart/form-data'>
			<input type="hidden" name="period" value="<?php echo $data[0]['contract_period']?>">
			<input type="hidden" name="contract_date" value="<?php echo $data[0]['contract_date']?>">
			<div class="row">
				<div class="form-body col-md-6">
					<!-- start installer div -->
					<div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Installer
							<span class="required">*</span>
						</label>
						<div class="col-md-10 col-sm-10">
							<select class="form-control" name="installer[]" required>
				            	<option value="">---- Please Select ----</option>
				            	<?php foreach ($installer as $oprator) { ?>
				                	<option value="<?php echo $oprator['teknisi_id'];?>"><?php echo $oprator['teknisi_name'];?></option>
				            	<?php } ?>
				        	</select>
						</div>
					</div>
					<?php for($i=0;$i<=3;$i++){ ?>
						<div class="form-group" id='installer-<?php echo $i; ?>' style="display: none;">
							<div class="form-group">
					        	<label class="control-label col-md-2">Installer <?php echo $i;?></label>
					       		<div class="col-md-10 col-sm-10">
					        		<select class="form-control"  id="select_installer_<?php echo $i?>" disabled style="width: 442px !important; margin-left: 9px !important; margin-bottom: -10px;" name="installer[<?php echo $i?>]">
					                	<option value="">---- Please Select ----</option>
					                	<?php foreach ($installer as $oprator) { ?>
					                    	<option value="<?php echo $oprator['teknisi_id']?>"><?php echo $oprator['teknisi_name'];?></option>
					                	<?php } ?>
					        		</select>
					        	</div>
					    	</div>
						</div>
					<?php } ?>
					<div style="margin-bottom: 15px; margin-left: 95px">
						<button type="button" class="btn btn-sm blue" id="add_installer" onclick="add('0')"><b>Add Teknisi</b></button>
						<button type="button"  class="btn btn-sm white" id="remove_installer" onclick="remove('0')" style=" display: none;"><b>Remove Teknisi</b></button>
					</div>
					<input type="hidden" name="count_instaler" value="0" id="counter_install-1">
					<!-- end installer div -->
                    <div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Install Date</label>
						<div class="col-md-10 col-sm-10">
							<div class="input-group date form_datetime">
								<input id="datepicker1"  width="442" name="install_date" class="form-control" placeholder="Select Install Date" readonly required /> 
	                		</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Working Day</label>
						<div class="col-md-10 col-sm-10">
							<input type="number" class="form-control" min="1" max="26" name="working_day" placeholder="Max 26 Days" required/>
						</div>
					</div>
					<!-- start teknisi div -->
					<div class="form-group">
						<label class="col-md-2 col-sm-2 control-label">Teknisi
							<span class="required">*</span>
						</label>
						<div class="col-md-10 col-sm-10">
							<select class="form-control" name="teknisi[]" required>
				            	<option value="">---- Please Select ----</option>
				            	<?php foreach ($teknisi as $oprator1) { ?>
				                	<option value="<?php echo $oprator1['teknisi_id']?>"><?php echo $oprator1['teknisi_name'];?></option>
				            	<?php } ?>
				        	</select>
						</div>
					</div>
					<?php for($i=0;$i<=3;$i++){ ?>
						<div class="form-group" id='technician-<?php echo $i; ?>' style="display: none;">
							<div class="form-group">
					        	<label class="control-label col-md-2">Teknisi <?php echo $i;?></label>
					       		<div class="col-md-10 col-sm-10">
					        		<select class="form-control" disabled  id="select_teknisi_<?php echo $i?>" style="width: 442px !important; margin-left: 9px !important; margin-bottom: -10px;" name="teknisi[]">
					                	<option value="">---- Please Select ----</option>
					                	<?php foreach ($teknisi as $oprator1) { ?>
					                    	<option value="<?php echo $oprator1['teknisi_id']?>"><?php echo $oprator1['teknisi_name'];?></option>
					                	<?php } ?>
					        		</select>
					        	</div>
					    	</div>
						</div>
					<?php } ?>
					<div style="margin-bottom: 15px; margin-left: 95px">
						<button type="button" class="btn btn-sm blue" id="add_teknisi" onclick="add('1')"><b>Add Teknisi</b></button>
						<button type="button"  class="btn btn-sm white tek2-1" id="remove_teknisi" onclick="remove('1')" style=" display: none;"><b>Remove Teknisi</b></button>
					</div>
					<input type="hidden" name="count_teknisi" value="0" id="counter-1">
					<!-- end teknisi div -->
					<div class="form-group">
                        <label class="control-label col-md-2">Contract Purpose
                        </label>
                        <div class="col-md-10">
                            <select name="assign_status" class="form-control" required>
								<?php if ($data[0]['assign_status'] == 1){ ?>
									<option selected value="1">Verified</option>
									<option value="0">Not Verified</option>
								<?php }else{ ?>
									<option selected value="0">Not Verified</option>
									<option value="1">Verivied</option>
								<?php } ?>
							</select>
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
										<th>Number Of Product</th>
										<th>Product Price</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									for($i=0; $i <count($product) ; $i++){
								?>
									<tr class="gradeX">
									<input type="hidden" value="<?php echo $product[$i]['product_id']?>" name="product_id[]">
										<td><?php echo $no;?></td>
										<td><?php echo $product[$i]["product_code"];?></td>
										<td><?php echo $product[$i]["product_name"];?></td>
										<td><?php echo $product[$i]["category_name"];?></td>
										<td>
											<input type="number" name="product_qty[]" class="form-control" readonly id="<?php echo "number_of_product".$product[$i]["product_id"]?>" value="<?php echo $product[$i]['amount']?>"/>
										</td>
										<td>
											<input type="number" readonly name="price[]" class="form-control" id="<?php echo "price".$product[$i]["product_id"]?>" value="<?php echo $product[$i]['price']?>"/>
										</td>
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
										<th>Package Name</th>
										<th>Number Of Package</th>
										<th>Package Price</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									for($i=0; $i <count($package) ; $i++){
								?>
									<tr class="gradeX">
									<input type="hidden" value="<?php echo $package[$i]['package_id']?>" name="package_id[]">
										<td><?php echo $no;?></td>
										<td><?php echo $package[$i]["package_name"];?></td>
										<td>
											<input type="number" name="package_qty[]" class="form-control" readonly id="<?php echo "number_of_product".$package[$i]["product_id"]?>" value="<?php echo $package[$i]['product_package_qty']?>"/>
										</td>
										<td>
											<input type="number" readonly name="package_price[]" class="form-control" id="<?php echo "price".$package[$i]["product_id"]?>" value="<?php echo $package[$i]['price']?>"/>
										</td>
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

<!-- add and remove oprator -->
<script>
	function add(oprator) {
		
		if (oprator == 1) {

			var count = parseInt($('#counter-1').val())+1;
			$('#counter-1').val(count);
			$('#select_teknisi_'+count).removeAttr('disabled');
			$('#technician-'+count).removeAttr('style');
			if (count == 3) {
					// $('#add_teknisi').hide();
			}
			$('#remove_teknisi').removeAttr('style');
		}else{
			var count = parseInt($('#counter_install-1').val())+1;
			$('#counter_install-1').val(count);
			$('#select_installer_'+count).removeAttr('disabled');
			$('#installer-'+count).removeAttr('style');
			if (count == 3) {
					// $('#add_installer').hide();
			}
			$('#remove_installer').removeAttr('style');
		}
	}

	function remove(oprator) {
		if (oprator == 1) {
			var count = parseInt($('#counter-1').val());
			var new_count = count-1;
			$('#counter-1').val(new_count);
			$('#technician-'+count).hide();
			$('#select_teknisi_'+count).addAttr('disabled');
			if (count <= 2) {
				// $('#add_teknisi').show();
			}
			if (new_count == 1) {
				// $('#remove_teknisi').hide();
			}
		}else{
			var count = parseInt($('#counter_install-1').val());
			var new_count = count-1;
			$('#counter_install-1').val(new_count);
			$('#installer-'+count).hide();
			$('#select_installer_'+count).addAttr('disabled');
			if (count <= 2) {
				// $('#add_installer').show();
			}
			if (new_count == 1) {
				// $('#remove_installer').hide();
			}
		}
	}
</script>

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