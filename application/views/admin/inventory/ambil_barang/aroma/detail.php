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
							<th>Product Aroma Name</th>
							<th>Total</th>
							<th>Gudang</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["product_aroma_name"];?></td>
							<td><?php echo $data[$i]["aroma_taked"];?></td>
							<td><?php echo $data[$i]['gudang_name'];?></td>
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