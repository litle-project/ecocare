<h1><?php echo $title.' For '.date('F');?></h1>
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
						<th>Customer Name</th>
						<th>Install Date</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td><?php echo $data[$i]["customer_name"];?></td>
							<td><?php echo $data[$i]["install_date"];?></td>
						</tr>
					<?php
							$no++;
						}
					?>
					</tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Contract No</th>
                            <th>Customer Name</th>
                            <th>Install Date</th>
                        </tr>
                    </tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
