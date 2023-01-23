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
							<th>Contract No</th>
							<th>Customer</th>
							<th>Print</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data); $i++){ 
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td><?php echo $data[$i]["customer_name"];?></td>
							<td>
								<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["contract_id"]."");?>" class="btn btn-sm yellow"><b>Detail</b></a>
								<a href="<?php echo site_url($this->uri->segment(1)."/print_ba/".$data[$i]["contract_id"]."");?>" class="btn btn-sm blue"><b>Print BA</b></a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>