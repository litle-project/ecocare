<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<form action="" method="post" class="form-horizontal" enctype='multipart/form-data' novalidate>
					<div class="form-group">
	                    <label class="control-label col-md-2">Contract No.
	                    <span class="required">
	                        *
	                    </span>
	                    </label>
	                    <div class="col-md-8">
	                    	<input type="text" name="contract_no" class="form-control" readonly value="<?php echo $data[0]['contract_no']?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-2">Branch
	                    <span class="required">
	                        *
	                    </span>
	                    </label>
	                    <div class="col-md-8">
	                    	<select class="form-control" name="branch_id" required>
	                    		<?php foreach ($branch as $row) { ?>
	                    		<option value="<?php echo $row['branch_id'];?>" <?php if($data[0]['branch_id'] == $row['branch_id']){ echo "selected"; } ?> ><?php echo $row["branch_name"];?></option>
	                    		<?php }?>
	                    	</select>
						</div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-2">Technician
	                    <span class="required">
	                        *
	                    </span>
	                    </label>
	                    <div class="col-md-8">
							<select name="teknisi_id" class="selectpicker form-control" data-live-search="true" title="Default" required>
                                <?php foreach ($teknisi as $row){ ?>
                                <option <?php if($data[0]['teknisi_id'] == $row['teknisi_id']){ echo "selected"; }?> value="<?php echo $row['teknisi_id'];?>"><?php echo $row['teknisi_name']; ?></option>
                                <?php } ?>
                            </select>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-md-2">Stock Has Taked
	                    </label>
	                    <div class="col-md-8">
							<input type="text" name="stock_taked" class="form-control" value="<?php echo $data[0]['product_taked'];?>" readonly>
	                    </div>
	                </div>
	                <br>
					<div class="portlet box grey">
						<div class="portlet-body">										
							<table class="table table-striped table-bordered table-hover display">
								<thead>
									<tr>
										<th>No</th>
										<th>Product Code</th>
										<th>Type</th>
										<th>Product Name</th>
										<th>Product Category</th>
										<th>Aroma</th>
										<th>Available</th>
										<th>Gudang</th>
										<th>Number Of Product</th>
										<th>Select Aroma</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									for($i=0; $i <count($product) ; $i++){
										if($product[$i]['aroma'] == "0"){
											$disabled = "disabled";
										}else{
											$disabled= "";
											$readonly= "readonly";
										}

									// gudang selection
									if ($product[$i]['aroma'] == "1") {
										$none = "disabled";
									}else{
										$none = "";
									}

									// product disabled
									if ($product[$i]['product_taked'] == $product[$i]['product_request']) {
										$aroma = "disabled";
									}else{
										$aroma = "";
									}

								?>
									<tr class="gradeX">
										<td>
											<?php echo $no;?>

										</td>
										<td style="display: none;"><input type="checkbox" <?php echo $none; ?> name="product[]" id="product_id_<?php echo $i?>" value='<?php echo $product[$i]["product_id"];?>' checked readonly></td>
										<td><?php echo $product[$i]["product_code"];?></td>
										<td><?php if($product[$i]['product_type'] == '1'){echo "Product";}else{echo "Package";} ?></td>
										<td><?php echo $product[$i]["product_name"];?></td>
										<td><?php echo $product[$i]["category_name"];?></td>
										<td>
											<?php if($product[$i]['aroma'] == '1'){ ?>
												<span style="background-color: #1cd063; color:white; padding: 5px 22px 5px 22px !important;">Yes</span>
											<?php }else{ ?>
												<span style="background-color: #ff5151; color:white; padding: 5px 22px 5px 22px !important;">No</span>
											<?php } ?>
										</td>
										<td id="available<?php echo $i?>"><center><i class="fa fa-minus" aria-hidden="true"></i></center></td>
										<td>
											<select class="form-control" id="gudang_id_<?php echo $i?>" name="gudang_id[]" <?php echo $none;?> required>
													<option value="">---- Please Select ----</option>
												<?php foreach($gudang as $unit){ ?>
													<option <?php if($product[$i]['gudang_id'] == $unit['gudang_id']){ echo "selected"; } ?> value="<?php echo $unit['gudang_id']?>"><?php echo $unit['gudang_name']; ?></option>
												<?php } ?>
											</select>
											<input type="hidden" <?php echo $none; ?> name="history_product_id[]" value="<?php echo $product[$i]['history_product_id']?>">
										</td>
										
										<td>
											<?php
											if (!empty($product[$i]["package_id"])) { ?>

												<input type="number" name="number_of_product<?php echo $i; ?>" value="<?php echo $data[$i]["total_product"]; ?>" max="<?php echo $data[$i]["stock_request"]-$data[$i]["product_taked"]; ?>" min="0" class="form-control">
											
											<?php }else{ ?>

											<input type="text" name="product_taked[]" value="<?php echo $product[$i]["product_request"]; ?>" <?php echo $aroma; ?> min="0" id="product_<?php echo $product[$i]['product_id']?>" max="<?php echo $product[$i]["product_request"]-$product[$i]["product_taked"]; ?>" class="form-control">
											<?php } ?>
										 </td>
										 <td>
										 	<a href="<?php echo site_url('ambil_barang/aroma/'.$product[$i]["history_product_id"].'');?>" type="button"<?php echo $aroma.$disabled; ?> class="btn green">Take Aroma</a>
										 </td>
									</tr>
								<?php $no++; }?>
								</tbody>
							</table>
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
	</div>
</div>

<script>
<?php for ($i=0; $i<count($product); $i++) { ?>

	$('#gudang_id_<?php echo $i?>').change(function() {
			var gudang 		= $('#gudang_id_<?php echo $i?>').val();
			var product 	= $('#product_id_<?php echo $i?>').val();
			var input 		=  ('<?php echo $product[$i]['product_id']?>');
				// alert(input);
				$.ajax({
			    type: "json",
			    url: "<?php echo base_url().'ambil_barang/validate_inventory/'?>"+gudang+"/"+product+"/"+input,
			    success: function(response){ 
		    		$('#available<?php echo $i?>').empty().append(response);
		    		$('#product_<?php echo $product[$i]['product_id']?>').empty().append(response);
				},
			    error: function(){
			    	alert('Please Create Product Aroma Before for This Product');
			   	}
		   }); 

		});
<?php } ?>
</script>