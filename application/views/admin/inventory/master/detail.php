<h1><?php if(!empty($data)){echo $title.' at '. $data[0]['product_name'];}?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">
				<div class="table-toolbar">
				</div>
				
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Product Name</th>
							<th>Product Stock</th>
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
							<td><?php echo $data[$i]["stock"];?></td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
				</table>
				<div class="form-actions fluid">
					<div class="col-md-12">
						<center>
							<button type="reset" class="btn black" onclick="window.history.back();"  id="reset"><b>Back</b></button>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>