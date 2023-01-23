<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<h1><?php echo $title;?></h1>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5">
			<ul class="breadcrumb pull-right">
				<li>
					<a href="#" onclick="window.location.href='<?php echo site_url($this->uri->segment(1));?>'">package</a>
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

				<form action="<?php echo base_url('product_package/edit/'.$data[0]['package_id'])?>" method="post" class="form-horizontal" enctype='multipart/form-data'>
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Package Name</label>
						<div class="col-md-8 col-sm-8">
							<input type="text" name="package_name" value="<?php echo $data[0]['package_name']?>" class="form-control" placeholder="Package Name" required>
						</div>
					</div>
					<input type="hidden" name="package_detail_id_1" value="<?php echo $detail_product[0]['package_detail_id']?>">
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Package Description</label>
						<div class="col-md-8 col-sm-8">
							<textarea class="form-control ckeditor" name="package_desc"><?php echo $data[0]['package_desc']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product</label>
						<div class="col-md-8 col-sm-8">
							<select name="product_id_1" class="form-control" required>
								<option value="">---- Please Select ----</option>
								<?php foreach($product as $row){ ?>
									<option value="<?php echo $row['product_id']?>" <?php if($row['product_id'] == $detail_product[0]['product_id']){echo "selected";} ?> ><?php echo $row['product_name']?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Quantity</label>
						<div class="col-md-8 col-sm-8">
							<input type="number" min="1" value="<?php echo $detail_product[0]['product_qty']?>" name="product_qty_1" placeholder="Eg: 10" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Total Per Install</label>
						<div class="col-md-8 col-sm-8">
							<input type="number" min="1" value="<?php echo $detail_product[0]['total_per_install']?>" name="total_per_install_1" placeholder="Eg: 2" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Product Total Per Service</label>
						<div class="col-md-8 col-sm-8">
							<input type="number" min="1" value="<?php echo $detail_product[0]['total_per_service']?>" name="total_per_service_1" placeholder="Eg: 4" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Service Period</label>
						<div class="col-md-8 col-sm-8">
							<select name="service_period_1" required class="form-control">
								<option value="">---- Please Select ----</option>
								<?php if($detail_product[0]['service_period'] == 1){ ?> 
									<option selected value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif($detail_product[0]['service_period'] == 2){ ?>
									<option value="1">/ 1 Month</option>
									<option selected value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif($detail_product[0]['service_period'] == 3){ ?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option selected value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 4){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option selected value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 5){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option selected value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 6){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option selected value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 7){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option selected value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 8){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option selected value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 9){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option selected value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 10){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option selected value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 11){?>
									<option value="1">/ 1 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option selected value="11">/ 11 Month</option>
									<option value="12">/ 12 Month</option>
								<?php }elseif ($detail_product[0]['service_period'] == 12){?>
									<option value="1">/ 12 Month</option>
									<option value="2">/ 2 Month</option>
									<option value="3">/ 3 Month</option>
									<option value="4">/ 4 Month</option>
									<option value="5">/ 5 Month</option>
									<option value="6">/ 6 Month</option>
									<option value="7">/ 7 Month</option>
									<option value="8">/ 8 Month</option>
									<option value="9">/ 9 Month</option>
									<option value="10">/ 10 Month</option>
									<option value="11">/ 11 Month</option>
									<option selected value="12">/ 12 Month</option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<?php
						for($i=2;$i<=count($detail_product);$i++){
					?>
					<input type="hidden" name="package_detail_id_<?php echo $i?>" value="<?php echo $detail_product[$i-1]['package_detail_id']?>">
					<div class="form-group" id='row1-<?php echo $i; ?>' style="display: none;">
						<h3 class="form-section"></h3>
						<div class="form-group">
	                        <label class="control-label col-md-3">Product <?php echo $i;?></label>
	                        <div class="col-md-8">
	                            <select name="product_id_<?php echo $i?>" class="form-control" >
									<option value="">---- Please Select ----</option>
									<?php foreach($product as $row){ ?>
										<option <?php if($row['product_id'] == $detail_product[$i-1]['product_id']){echo "selected";} ?> value="<?php echo $row['product_id']?>"><?php echo $row['product_name']?></option>
									<?php } ?>
								</select>
	                        </div>
	                    </div>
						<div class="form-group">
							<label class="col-md-3 col-sm-3 control-label">Product Quantity <?php echo $i;?></label>
							<div class="col-md-8 col-sm-8">
								<input type="number" min="1" value="<?php echo $detail_product[$i-1]['product_qty']?>" name="product_qty_<?php echo $i?>" placeholder="Eg: 2" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-sm-3 control-label">Product Total Per Install <?php echo $i;?></label>
							<div class="col-md-8 col-sm-8">
								<input type="number" min="1" value="<?php echo $detail_product[$i-1]['total_per_install']?>" name="total_per_install_<?php echo $i?>" placeholder="Eg: 2" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-sm-3 control-label">Product Total Per Service <?php echo $i;?></label>
							<div class="col-md-8 col-sm-8">
								<input type="number" min="1" value="<?php echo $detail_product[$i-1]['total_per_service']?>" name="total_per_service_<?php echo $i?>" placeholder="Eg: 4" class="form-control" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-sm-3 control-label">Service Period</label>
							<div class="col-md-8 col-sm-8">
								<select name="service_period_<?php echo $i?>" class="form-control">
									<option value="">---- Please Select ----</option>
									<?php if($detail_product[$i-1]['service_period'] == 1){ ?> 
										<option selected value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif($detail_product[$i-1]['service_period'] == 2){ ?>
										<option value="1">/ 1 Month</option>
										<option selected value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif($detail_product[$i-1]['service_period'] == 3){ ?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option selected value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 4){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option selected value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 5){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option selected value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 6){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option selected value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 7){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option selected value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 8){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option selected value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 9){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option selected value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 10){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option selected value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 11){?>
										<option value="1">/ 1 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option selected value="11">/ 11 Month</option>
										<option value="12">/ 12 Month</option>
									<?php }elseif ($detail_product[$i-1]['service_period'] == 12){?>
										<option value="1">/ 12 Month</option>
										<option value="2">/ 2 Month</option>
										<option value="3">/ 3 Month</option>
										<option value="4">/ 4 Month</option>
										<option value="5">/ 5 Month</option>
										<option value="6">/ 6 Month</option>
										<option value="7">/ 7 Month</option>
										<option value="8">/ 8 Month</option>
										<option value="9">/ 9 Month</option>
										<option value="10">/ 10 Month</option>
										<option value="11">/ 11 Month</option>
										<option selected value="12">/ 12 Month</option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<?php
							}
					?>
					<div class="form-group">
						<input type="hidden" name="products" id="photos-1"><br>
						<center>
							<button type="button" id="addRow2-1" class="btn" row="2"><b>Add More Product</b></button>
							<button type="button"  class="btn yellow mnc2-1" id="cancel2-1" style=" display: none;"><b>Remove</b></button>
						</center>
					</div>
					
				</div>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="submit" class="btn green"><b>Submit</b></button>
							<button type="reset" class="btn black" onclick="window.history.back();" id="reset"><b>Back</b></button>
						</center>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		<?php
		    for ($i=1; $i<=10; $i++){
		?>
		var xx<?php echo $i; ?> = 1;
		$('#photos-<?php echo $i; ?>').val(xx<?php echo $i; ?>);
		$('#addRow2-<?php echo $i; ?>').click(function(){
			$(".mnc2-<?php echo $i; ?>").fadeIn();
			$(this).attr('disabled','disabled');
			row = $(this).attr('row');
			$("input#package_id"+row).attr("required",true);
			$("input#package_detail_qty"+row).attr("required",true);
			$('#row<?php echo $i; ?>-'+row).fadeIn(function(){
				row++;
				xx<?php echo $i; ?>=xx<?php echo $i; ?>+1;    
				$('#addRow2-<?php echo $i; ?>').attr('row',row);
				$('#addRow2-<?php echo $i; ?>').removeAttr('disabled');
				$('#photos-<?php echo $i; ?>').val(xx<?php echo $i; ?>);   
				//$('#admins1').val(x4);
			});	    
		});
		
		$('#cancel2-<?php echo $i; ?>').click(function(){
			row=$("#addRow2-<?php echo $i; ?>").attr('row');
			//alert (row);
			row=row-1;
			xx<?php echo $i; ?>=xx<?php echo $i; ?>-1;		
			$("input#package_id"+row).attr("required",false);
			$("input#package_detail_qty"+row).attr("required",false);
			$("input#photos-<?php echo $i; ?>").val(xx<?php echo $i; ?>);
			//$("input#admins1").val(x4);
			$('#row<?php echo $i; ?>-'+row).hide();
			if(row==2){
				$(".mnc2-<?php echo $i; ?>").hide();
			}
			$('#addRow2-<?php echo $i; ?>').removeAttr('disabled');
			$("#addRow2-<?php echo $i; ?>").attr('row',row);
		});

		<?php
		    }
		?>
	});
</script>