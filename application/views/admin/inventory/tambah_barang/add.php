<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Inventory</a>
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
				<form action="<?php echo base_url().$this->uri->segment(1); ?>/add" method="post" class="form-horizontal" enctype='multipart/form-data ' onsubmit="return check_if_equal_to_stock()"> <!-- onsubmit="return check_if_equal_to_stock()" -->
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Product</label>
						<div class="col-md-8">
							<select name="product_id" class="form-control" id="product_id" required>
								<option value="">---- Please Select -----</option>
								<?php foreach ($product as $products) { ?>
									<option value="<?php echo $products['product_id'];?>"><?php echo $products['product_name'] ?></option>
								<?php  } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Branch</label>
						<div class="col-md-8">
							<select name="branch_id" class="form-control" id="branch_id" required>
								<option value="">---- Please Select -----</option>
								<?php foreach ($branch as $cabang) { ?>
									<option value="<?php echo $cabang['branch_id']?>"><?php echo $cabang['branch_name'];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Unit Gudang</label>
						<div class="col-md-8">
							<select name="gudang_id" class="form-control" id="gudang_id" required>
								<option value="">---- Please Select -----</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Minimum Stock</label>
						<div class="col-md-8">
							<input type="number" required class="form-control" min="1" placeholder='Minimum Stock' name="min_stock"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Stock</label>
						<div class="col-md-8" id="div_stock">
							<input type="number" class="form-control" readonly min="1" placeholder='Stock'/>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-12" style="padding-top: 20px;">
							<div class="portlet box grey">
								<div class="portlet-body" id="list_aroma">										
									<table class="table table-striped table-bordered table-hover display">
										<thead>
											<tr>
												<th>No</th>
												<th>Check</th>
												<th>Product Aroma</th>
												<th>Product Quantity</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn green" id="submit"><b>Submit</b></button>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
						</center>
					</div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>

<!-- get gudang -->
<script>
	$('#branch_id').change(function() {
			var branch =  $('#branch_id').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'tambah_barang/cek_gudang/'?>"+branch,
			    success: function(response){ 
		    		$('#gudang_id').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Warehouse Before');
			   	}
		   }); 

		});
</script>

<!-- get aroma -->
<script>
	$('#product_id').change(function() {
			var product =  $('#product_id').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'tambah_barang/cek_aroma/'?>"+product,
			    success: function(response){ 
		    		$('#list_aroma').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Product Aroma Before for This Product');
			   	}
		   }); 

		});
</script>

<!-- validate aroma -->
<script>
	$('#product_id').change(function() {
			var product =  $('#product_id').val();
				// alert(country);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'inventory_master/validate_aroma/'?>"+product,
			    success: function(response){ 
		    		$('#div_stock').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Product Aroma Before for This Product');
			   	}
		   }); 

		});
</script>

<script>
	// var aroma_num_rows;
	var id_checkbox = [];
	var index = 0;
	function input_qty(checkbox_value) {
		if(checkbox_value.checked) {
			// alert(checkbox_value.value);
			$('#product_aroma_qty'+checkbox_value.value).removeAttr('disabled');
			id_checkbox[index] = checkbox_value.value; 
			index++; 
		}else{
			$('#product_aroma_qty'+checkbox_value.value).attr('disabled','disabled');	
			$('#product_aroma_qty'+checkbox_value.value).val("");
			var length = id_checkbox.length;
			for(var i=0;i<length;i++) {
				// alert("here 0");
				if(id_checkbox[i] == checkbox_value.value) {
					// alert("here 1");
					id_checkbox.splice(i,1);
					index--;
					// alert("myarray "+id_checkbox);
					// alert("index "+index);
				}
			}
		}
	}
	
	function check_if_equal_to_stock() {

		// alert("stock : "+ stock);
		// alert("submit : "+ submit);
		// alert("length : "+ length);
		// alert("array 0 : "+ id_checkbox[0]);
		// alert("product_aroma_qty8 : "+ $('#product_aroma_qty'+id_checkbox[0]).val());
		// return false;
		var stock = Number($("#stock").val());
		var submit = Number(0);
		var length = id_checkbox.length;
		var table = $('#sample_editable_1').DataTable();

		if(table.fnSettings().aoData.length===0) {
		    // alert('no data');
		    // return false;
		} else {
			if(length == 0){
			    alert('at least must fill one aroma ');
			    return false;

			}else{
				for(var i=0;i<length;i++) {
					submit += Number($('#product_aroma_qty'+id_checkbox[i]).val());
				}
				if(length>0) {
					if(submit != stock) {
						alert("Stock value not equal to Product Aroma Quantity");
						return false;
					}
				}
			}
		}
	}
</script>