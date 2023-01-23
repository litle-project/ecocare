<div class="row">
	<h3 style="padding-top:0;">Detail Product of Package <?php echo $data[0]['package_name']?></h3>
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
							<th>Gudang</th>
							<th>Number Of Product Complaint</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="selected_only">
					<?php
						$no=1;
						for($i=0; $i <count($product) ; $i++){
					?>
						<tr class="gradeX">
						<form action="<?php echo base_url("return_barang/return_product_package/".$product_package[0]['contract_schedule_id']."");?>" method="post" autocomplete="off">

							<td><?php echo $no;?></td>
							<td>
								<input type="checkbox" name="product_id" value='<?php echo $product[$i]["product_id"];?>' onchange="input_price2(this)">
							</td>
							<td><?php echo $product[$i]["product_code"];?></td>
							<td><?php echo $product[$i]["product_name"];?></td>
							<td><?php echo $product[$i]["category_name"];?></td>
							<td hidden>
								<input type="hidden" name="contract_id" value="<?php echo $contract[0]['contract_id']?>">
							</td>
							<td>
								<select class="form-control" name="gudang_id" id="gudang_id<?php echo $product[$i]["product_id"]; ?>" required disabled>
									<option value="">---- Please Select ----</option>
									<?php foreach ($gudang as $key) { ?>
										<option value="<?php echo $key['gudang_id']?>"><?php echo $key['gudang_name']?></option>
									<?php } ?>
								</select>
							</td>
							<td>
								<input type="number" min="0" max="<?php echo $product[$i]['product_taked']?>" name="product_qty" class="form-control" id="product<?php echo $product[$i]["product_id"]; ?>" value="<?php echo $product[$i]['product_taked']?>" required disabled>
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
					<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $contract[0]['branch_id']?>">
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
		<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
	</center>
</div>

<!-- validate not aroma -->
<script type="text/javascript">
	function warning() {
				alert("Sorry This Product Can't Returned By System Because This Product Is Material!");
			}		
</script>

<!-- validate gudang -->
<script>
	<?php for ($i=0; $i<count($product); $i++) { ?>
		$('#gudang_id<?php echo $product[$i]["product_id"]; ?>').change(function() {
			var branch =  $('#branch_id').val();
			var gudang =  $('#gudang_id<?php echo $product[$i]["product_id"]; ?>').val();
			var product =  ('<?php echo $product[$i]['product_id']?>');
				// alert(product);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'return_barang/validate_gudang/'?>"+gudang+"/"+branch+"/"+product,
			    success: function(response){ 
		    		$('#product<?php echo $product[$i]["product_id"]; ?>').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Warehouse Before');
			   	}
		   }); 

		});
	<?php } ?>
</script>

<!-- disabled and enable input -->
<script>
	function input_price2(checkbox_value2) {
		if(checkbox_value2.checked) {
			// alert(checkbox_value2.value);
			$('#product'+checkbox_value2.value).removeAttr('disabled');
			$('#gudang_id'+checkbox_value2.value).removeAttr('disabled');
		}else{
			$('#product'+checkbox_value2.value).attr('disabled','disabled');
			$('#gudang_id'+checkbox_value2.value).attr('disabled','disabled');
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