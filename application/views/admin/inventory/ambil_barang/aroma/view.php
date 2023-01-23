<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">Ambil Barang</a>
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
				<form action="<?php echo base_url().$this->uri->segment(1); ?>/aroma" method="post" class="form-horizontal" enctype='multipart/form-data ' onsubmit="return check_if_equal_to_stock()">
				<input type="hidden" id="product_id" name="product_id" value="<?php echo $data[0]['product_id']?>">
				<input type="hidden" name="contract_id" value="<?php echo $data[0]['contract_id']?>">
				<input type="hidden" name="contract_history_id" value="<?php echo $data[0]['contract_history_id']?>">
				<input type="hidden" name="history_product_id" value="<?php echo $data[0]['history_product_id']?>">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Product</label>
						<div class="col-md-8">
							<input type="text" class="form-control" readonly value="<?php echo $data[0]['product_name']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Gudang</label>
						<div class="col-md-8 col-sm-8">
							<select class="form-control" name="gudang_id" id="gudang_id" required>
								<option value=""> ---- Please Select ----</option>
								<?php foreach($gudang as $gd){?>
									<option value="<?php echo $gd['gudang_id']?>"><?php echo $gd['gudang_name']?></option>
								<?php } ?>
							</select>
							<span id="span"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Quantity Requested</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" class="form-control" min="1" placeholder='Stock' name="product_stock" id="stock" value="<?php echo $data[0]['product_request']?>" readonly />
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
										<th>Stock Available</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<!-- <tbody>
								<?php
									$no=1;
									for($i=0; $i <count($aroma); $i++){
								?>
									<tr class="gradeX"">
										<td><?php echo $no;?></td>
										<td><input type="checkbox" class="checkbox" name="product_aroma[]" value='<?php echo $aroma[$i]["product_aroma_id"];?>' onchange="input_qty(this)"></td>
										<td><?php echo $aroma[$i]["product_aroma_name"];?></td>
										<td><?php echo form_input("product_aroma_qty".$aroma[$i]["product_aroma_id"],"","class='form-control' id='product_aroma_qty".$aroma[$i]["product_aroma_id"]."' disabled onkeyup='sum_aroma_qty(this,this.value)' ");?></td>
									</tr>
								<?php $no++; }?>
								</tbody> -->
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

<!-- validate gudang -->
<script>
	$('#gudang_id').change(function() {
			var gudang 		= $('#gudang_id').val();
			var product 	= $('#product_id').val();
				// alert(product);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'ambil_barang/validate_gudang/'?>"+gudang+"/"+product,
			    success: function(response){ 
		    		$('#span').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Product Aroma Before for This Product');
			   	}
		   }); 

		});
</script>

<!-- get aroma -->
<script>
	$('#gudang_id').change(function() {
			var gudang 		= $('#gudang_id').val();
			var product 	= $('#product_id').val();
				// alert(product);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'ambil_barang/cek_aroma/'?>"+gudang+"/"+product,
			    success: function(response){ 
		    		$('#list_aroma').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Product Aroma Before for This Product');
			   	}
		   }); 

		});
</script>

<script>

	$(document).ready(function(){
		var xx1 = 0;
		$('#photos-1').val(xx1);
		$('#addRow2-1').click(function(){
			$(".mnc2-1").fadeIn();
			$(this).attr('disabled','disabled');
			$(this).attr('disabled','disabled');
			row = $(this).attr('row');
			$("input#product_image"+row).attr("required",true);
			$('#row1-'+row).fadeIn(function(){
				row++;
				xx1=xx1+1;    
				$('#addRow2-1').attr('row',row);
				$('#addRow2-1').removeAttr('disabled');
				$('#photos-1').val(xx1);   
				//$('#admins1').val(x4);
			});	    
		});
		
		$('#cancel2-<?php echo $i; ?>').click(function(){
			row=$("#addRow2-1").attr('row');
			//alert (row);
			row=row-1;
			xx1=xx1-1;		
			$("input#product_image"+row).attr("required",false);
			$("input#photos-1").val(xx1);
			//$("input#admins1").val(x4);
			$('#row1-'+row).hide();
			if(row==1){
				$(".mnc2-<?php echo $i; ?>").hide();
			}
			$('#addRow2-1').removeAttr('disabled');
			$("#addRow2-1").attr('row',row);
		});
	});
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
				}
			}
		}
	}

	function check_if_equal_to_stock() {
		var stock = Number($("#stock").val());
		var submit = Number(0);
		console.log(submit);
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