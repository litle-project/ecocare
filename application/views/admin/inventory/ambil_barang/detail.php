<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Product Name</th>
							<th>Product Code</th>
							<th>Product Category</th>
							<th>Aroma</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
							if ($data[$i]['aroma'] == 0) {
								$disabled = "disabled";
							}else{
								$disabled = "";
							}
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["product_name"];?></td>
							<td><?php echo $data[$i]["product_code"];?></td>
							<td><?php echo $data[$i]["category_name"];?></td>
							<td>
								<?php if ($data[$i]['aroma'] == 1) {
									echo "Have Aroma";
								}else{
									echo "Haven't Aroma";
								} ?>
							</td>
							<td><?php echo $data[$i]['product_request'];?></td>
							<td>
								<a <?php echo $disabled;?> href="<?php echo site_url($this->uri->segment(1)."/detail_aroma/".$data[$i]["history_aroma_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
							</td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="form-actions fluid col-md-12">
		<center>
			<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
		</center>
	</div>
</div>