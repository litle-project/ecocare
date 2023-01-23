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
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Manage Contract Complaint</a>
				</li>
				<li>
					<span><?php echo $title;?></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 col-sm-9">
		<br/><br/>
		<form action="" method="post" autocomplete="off" class="form-horizontal" enctype='multipart/form-data'>
			<div class="row">
				<div class="form-body col-md-12">
                    <div class="form-group">
						<label class="col-md-2 control-label">Complaint Date</label>
						<div class="col-md-10">
							<div class="col-md-10">
								<input type="text" class="form-control" placeholder="Select Complaint Date" name="complaint_date" readonly id="datepicker1" required/>
							</div>
						</div>
					</div>
					<!-- start teknisi div -->
					<div class="form-group">
						<label class="col-md-2 control-label">Teknisi
							<span class="required">*</span>
						</label>
						<div class="col-md-10">
							<div class="col-md-10">
								<select class="form-control" name="teknisi[]" required>
					            	<option value="">---- Please Select ----</option>
					            	<?php foreach ($teknisi as $oprator1) { ?>
					                	<option value="<?php echo $oprator1['teknisi_id']?>"><?php echo $oprator1['teknisi_name'];?></option>
					            	<?php } ?>
					        	</select>
							</div>
						</div>
					</div>
					<?php for($i=0;$i<=3;$i++){ ?>
						<div class="form-group" id='technician-<?php echo $i; ?>' style="display: none;">
				        	<label class="control-label col-md-2">Teknisi <?php echo $i;?></label>
				       		<div class="col-md-10 col-sm-10">
				       			<div class="col-md-10">
					        		<select class="form-control" disabled  id="select_teknisi_<?php echo $i?>" style="width: 725px !important; margin-bottom: -10px;" name="teknisi[]">
					                	<option value="">---- Please Select ----</option>
					                	<?php foreach ($teknisi as $oprator1) { ?>
					                    	<option value="<?php echo $oprator1['teknisi_id']?>"><?php echo $oprator1['teknisi_name'];?></option>
					                	<?php } ?>
					        		</select>
				       			</div>
				        	</div>
				    	</div>
					<?php } ?>
					<div style="margin-bottom: 15px; margin-left: 201px">
						<button type="button" class="btn btn-sm blue" id="add_teknisi" onclick="add('1')"><b>Add Teknisi</b></button>
						<button type="button"  class="btn btn-sm white tek2-1" id="remove_teknisi" onclick="remove('1')" style=" display: none;"><b>Remove Teknisi</b></button>
					</div>
					<input type="hidden" name="count_teknisi" value="0" id="counter-1">
					<!-- end teknisi div -->
					<div class="form-group">
						<label class="col-md-2 control-label">Reason Complaint</label>
						<div class="col-md-10">
							<div class="col-md-10">
								<select name="reason_complaint" class="form-control" required>
									<option value="">---- Please Select ----</option>
									<option value="1">Unit Damages / Not Working</option>
									<option value="2">Less Material</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Complaint Note</label>
						<div class="col-md-10">
							<div class="col-md-10">
								<textarea rows="4" class="form-control" name="complaint_note" placeholder="Type Detail Reason"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- //// -->
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
										<th>Number Of Product Complaint</th>
									</tr>
								</thead>
								<tbody class="selected_only">
								<?php
									$no=1;
									for($i=0; $i <count($product) ; $i++){
								?>
									<tr class="gradeX">
										<input type="hidden" disabled name="contract_detail_id[]" id='<?php echo "contract_detail_id".$product[$i]["product_id"]?>' value="<?php echo $product[$i]['contract_detail_id']?>">
										<td><?php echo $no;?></td>
										<td><input type="checkbox" name="product_id[]" value='<?php echo $product[$i]["product_id"];?>' onchange="input_price2(this)"></td>
										<td><?php echo $product[$i]["product_code"];?></td>
										<td><?php echo $product[$i]["product_name"];?></td>
										<td><?php echo $product[$i]["category_name"];?></td>
										<td><?php echo form_input("product_package_qty".$product[$i]["product_id"],"","class='form-control' id='product".$product[$i]["product_id"]."' required='required' disabled");?></td>
									</tr>
								<?php $no++; } ?>
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- //// -->
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
										<th>Number Of Package Complaint</th>
									</tr>
								</thead>
								<tbody class="selected_only">
								<?php
									$no=1;
									for($i=0; $i <count($package) ; $i++){
								?>
									<tr class="gradeX">
										<input type="hidden" disabled name="contract_detail_id[]" id='<?php echo "contract_detail_id".$package[$i]["package_id"]?>' value="<?php echo $package[$i]['contract_detail_id']?>">
										<td><?php echo $no;?></td>
										<td><input type="checkbox" name="package_id[]" value='<?php echo $package[$i]["package_id"];?>' onchange="input_price(this)"></td>
										<td><?php echo $package[$i]["package_name"];?></td>
										<td><?php echo form_input("package_qty".$package[$i]["package_id"],"","class='form-control' id='package".$package[$i]["package_id"]."' required='required' disabled");?></td>
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
					<button type="submit" class="btn green"><b>Submit</b></button>
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

<!-- add and remove oprator -->
<script>
	function add(oprator) {
		
		if (oprator == 1) {

			var count = parseInt($('#counter-1').val())+1;
			$('#counter-1').val(count);
			$('#select_teknisi_'+count).removeAttr('disabled');
			$('#technician-'+count).removeAttr('style');
			$('#remove_teknisi').removeAttr('style');
		}
	}

	function remove(oprator) {
		if (oprator == 1) {
			var count = parseInt($('#counter-1').val());
			var new_count = count-1;
			$('#counter-1').val(new_count);
			$('#technician-'+count).hide();
			$('#select_teknisi_'+count).addAttr('disabled');
			
		}
	}
</script>

<script>
	function input_price2(checkbox_value2) {
		if(checkbox_value2.checked) {
			// alert(checkbox_value2.value);
			$('#product'+checkbox_value2.value).removeAttr('disabled');
			$('#contract_detail_id'+checkbox_value2.value).removeAttr('disabled');
		}else{
			$('#product'+checkbox_value2.value).attr('disabled','disabled');
			$('#contract_detail_id'+checkbox_value2.value).attr('disabled','disabled');
		}
	}

	function input_price(checkbox_value2) {
		if(checkbox_value2.checked) {
			// alert(checkbox_value2.value);
			$('#package'+checkbox_value2.value).removeAttr('disabled');
			$('#contract_detail_id'+checkbox_value2.value).removeAttr('disabled');
			$('#price_package'+checkbox_value2.value).removeAttr('disabled');
		}else{
			$('#package'+checkbox_value2.value).attr('disabled','disabled');
			$('#contract_detail_id'+checkbox_value2.value).attr('disabled','disabled');
			$('#price_package'+checkbox_value2.value).attr('disabled','disabled');
		}
	}
</script>