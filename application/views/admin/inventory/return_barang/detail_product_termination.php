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
						for($i=0; $i <count($package) ; $i++){
					?>
						<tr class="gradeX">
						<form action="<?php echo base_url("return_barang/return_product/".$product[0]['contract_schedule_detail_id']);?>" method="post" autocomplete="off">

							<td><?php echo $no;?></td>
							<td>
								<input type="hidden" name="schedule_date" value="<?php echo $schedule[0]['schedule_date'];?>">
								<input type="hidden" name="schedule_type" value="<?php echo $schedule[0]['schedule_type'];?>">
								<input type="hidden" name="contract_schedule_id" value="<?php echo $product[0]['contract_schedule_id'];?>">
								<input type="hidden" name="contract_id" value="<?php echo $contract[0]['contract_id']?>">
								<input type="checkbox" name="product_id" value='<?php echo $package[$i]["product_id"];?>' onchange="input_price2(this)">
							</td>
							<td><?php echo $package[$i]["product_code"];?></td>
							<td><?php echo $package[$i]["product_name"];?></td>
							<td><?php echo $package[$i]["category_name"];?></td>
							<td>
								<select class="form-control" name="branch_id" id="branch_id1<?php echo $package[$i]["product_id"]; ?>" required disabled>
									<option value="">-- Please Select --</option>
									<?php foreach ($branch as $row) { ?>
										<option value="<?php echo $row['branch_id']?>"><?php echo $row['branch_name']?></option>
									<?php } ?>
								</select>
							</td>
							<td>
								<select class="form-control" name="gudang_id" id="gudang_id1<?php echo $package[$i]["product_id"]; ?>" required disabled>
									<option value="">-- Please Select --</option>
								</select>
							</td>
							<td>
								<span class="btn btn-xs red" disabled id="min1<?php echo $package[$i]["product_id"];?>" onclick="minus(<?php echo $package[$i]["product_id"];?>)"><b>-</b></span>
								<input type="number" readonly min="0" max="<?php echo $product[0]['package_qty']?>" value="<?php echo $product[0]['package_qty']?>" name="product_qty" class="form-control" id="product1<?php echo $package[$i]["product_id"]; ?>" required disabled>
								<span class="btn btn-xs green" disabled id="plus1<?php echo $package[$i]["product_id"];?>" onclick="plus(<?php echo $package[$i]["product_id"];?>)"><b>+</b></span>
							</td>
							<td>
								<input type="text" max="<?php echo $product[0]['package_qty']?>" min="0" readonly name="lost_qty" disabled id="lost1<?php echo $package[$i]["product_id"]; ?>" class="form-control">
								<input type="hidden" value="1" id="hidden1<?php echo $package[$i]["product_id"];?>">
								<input type="hidden" value="<?php echo $product[0]["package_qty"];?>" id="qty">
							</td>
							<td>
								<?php if($package[$i]['category_id'] == '1'){ ?>
									<button type="submit" disabled id="button1<?php echo $package[$i]["product_id"];?>" class="btn btn-sm blue"><b>Return</b></button>
								<?php }else{ ?>
									<span class="btn btn-sm blue" disabled id="button2<?php echo $package[$i]["product_id"];?>" onclick="warning()"><b>Return</b></span>
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

<!-- validate not aroma -->
<script type="text/javascript">
	function warning() {
				alert("Sorry This Product Can't Returned By System Because This Product Is Material!");
			}		
</script>

<!-- validate gudang -->
<script>
	<?php for ($i=0; $i<count($package); $i++) { ?>
		$('#branch_id1<?php echo $package[$i]["product_id"]; ?>').change(function() {
			var branch =  $('#branch_id1<?php echo $package[$i]["product_id"]; ?>').val();
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'return_barang/cek_gudang/'?>"+branch,
			    success: function(response){ 
				// alert(response);
		    		$('#gudang_id1<?php echo $package[$i]["product_id"]; ?>').empty().append(response);
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
			$('#branch_id1'+checkbox_value2.value).removeAttr('disabled');
			$('#gudang_id1'+checkbox_value2.value).removeAttr('disabled');
			$('#gudang_id'+checkbox_value2.value).removeAttr('disabled');
			$('#product1'+checkbox_value2.value).removeAttr('disabled');
			$('#lost1'+checkbox_value2.value).removeAttr('disabled');
			$('#button1'+checkbox_value2.value).removeAttr('disabled');
			$('#min1'+checkbox_value2.value).removeAttr('disabled');
			$('#plus1'+checkbox_value2.value).removeAttr('disabled');
			$('#button2'+checkbox_value2.value).removeAttr('disabled');
		}else{
			$('#branch_id1'+checkbox_value2.value).attr('disabled','disabled');
			$('#gudang_id1'+checkbox_value2.value).attr('disabled','disabled');
			$('#gudang_id'+checkbox_value2.value).attr('disabled','disabled');
			$('#product1'+checkbox_value2.value).attr('disabled','disabled');
			$('#lost1'+checkbox_value2.value).attr('disabled','disabled');
			$('#button1'+checkbox_value2.value).attr('disabled','disabled');
			$('#min1'+checkbox_value2.value).attr('disabled','disabled');
			$('#plus1'+checkbox_value2.value).attr('disabled','disabled');
			$('#button2'+checkbox_value2.value).attr('disabled','disabled');
		}
	}
</script>

<!-- calculator js -->
<script>
	<?php for ($i=0; $i<count($package); $i++) { ?>
		$('#product1<?php echo $package[$i]["product_id"]; ?>').change(function() {
			var product =  $('#product1<?php echo $package[$i]["product_id"]; ?>').val();
				// alert(product);
				var product_qty = '<?php echo $product[0]['product_qty'];?>';
				var result = (parseInt(product_qty) -  parseInt(product));
				// alert(result);
				$('#lost1<?php echo $package[$i]["product_id"]; ?>').val(result);
	    		return ('#lost1<?php echo $package[$i]["product_id"]; ?>').empty().append(result);
		   }); 

	<?php } ?>
</script>

<script>
	function minus(id){
		var product = $('#product1'+id).val();
		var hidden = $('#hidden1'+id).val();
		var qty = $('#qty').val();
		if (product === '' || product === 0 || product <= 0) {
			alert('Value Of Quantity Is Min!');
		}else{
			var result = product-hidden;
			var result2 = (qty - result);
			// alert(qty);
			$('#product1'+id).val(result);
			$('#lost1'+id).val(result2);
		}
		
	}

	function plus(id){
		var product = $('#product1'+id).val();
		var lost = $('#lost1'+id).val();
		var hidden = $('#hidden1'+id).val();
		var qty = $('#qty').val();
		if(lost === 0 || lost === "" || product === qty){
			alert('Value Of Quantity Is Max!');
		}else{
			var qty = parseInt(document.getElementById("qty").value, 10);
			var result = (parseInt(hidden)+parseInt(product));
			var result2 = (lost - hidden);

			// alert(lost);
			$('#product1'+id).val(result);
			$('#lost1'+id).val(result2);
		}
	}
</script>