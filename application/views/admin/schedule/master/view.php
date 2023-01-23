<h1><?php echo $title;?></h1>
<br/>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey">
			<div class="portlet-body">	
				<form id="basicForm2" class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
				<table class="table table-striped table-bordered table-hover" id="sample_editable_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Contract No</th>
							<th>Contract Period</th>
							<th>Contract Status</th>
							<th>Installer</th>
							<th>Assign Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						for($i=0; $i <count($data) ; $i++){
						// condition for edit
						if ($data[$i]['assign_status'] == '1') {
							$disable = 'disabled';
						}else{
							$disable = '';
						}

						// condition for view schedule
						if (empty($data[$i]['installer'])) {
							$schedule = 'disabled';
						}else{
							$schedule = '';
						}
					?>
						<tr class="gradeX">
							<td><?php echo $no;?></td>
							<td><?php echo $data[$i]["contract_no"];?></td>
							<td><?php echo $data[$i]["contract_period"];?> Month</td>
							<td>
								<?php if($data[$i]["contract_purpose"] == "1"){
									echo "Install";
								}elseif ($data[$i]["contract_purpose"] == "6") {
									echo "Trial";
								}elseif ($data[$i]["contract_purpose"] == "7") {
									echo "DO";
								}?>
							</td>
							<td>
								<?php if(!empty($data[$i]["installer"][0]['teknisi_name'])){ echo $data[$i]["installer"][0]['teknisi_name']; }else{ echo "Please Give Assignment Technician"; } ?>
							</td>
							<td>
								<?php if ($data[$i]["assign_status"] == 1) { ?>
									<span style="background-color: #1cd063; color:white; padding: 5px 22px 5px 22px !important;">Verivied</span>
								<?php }else{ ?>
									<span style="background-color: #d6d6d6; color:#908d8d; padding: 5px 10px 5px 10px !important;">Not Verivied</span>
								<?php }?>
							</td>
							<td>
							<a href="<?php echo site_url($this->uri->segment(1)."/edit/".$data[$i]["contract_id"]."");?>" class="btn btn-sm blue" <?php echo $disable?>><b>Edit</b></a>
							<a href="<?php echo site_url($this->uri->segment(1)."/detail/".$data[$i]["contract_id"]."");?>" class="btn btn-sm default" <?php echo $schedule?>><b>View Schedule</b></a>
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
</div>
<script>
    $(document).ready(function() {
        $("#operator").keyup(function() {
        	// alert($(this).val());
            $("#operator").autocomplete({
                source: "<?php echo site_url("assignment/get_operator")?>/" + $(this).val(),
                focus: function( event, ui ) {
                    $( "#operator" ).val( ui.item.label );
                    return false;
                },
                select: function( event, ui ) {
                    $( "#operator" ).val( ui.item.label );
                    $( "#operator_id" ).val( ui.item.staff_id );
                    return false;
                }
            });
        });
    });
</script>


<!-- search oprator dropdown by klewang -->
<script type="text/javascript">
	$(document).ready(function() {
	    $('#example').DataTable( {
	        initComplete: function () {
	            this.api().columns().every( function () {
	                var column = this;
	                var select = $('<select><option value=""></option></select>')
	                    .appendTo( $(column.footer()).empty() )
	                    .on( 'change', function () {
	                        var val = $.fn.dataTable.util.escapeRegex(
	                            $(this).val()
	                        );
	 
	                        column
	                            .search( val ? '^'+val+'$' : '', true, false )
	                            .draw();
	                    } );
	 
	                column.data().unique().sort().each( function ( d, j ) {
	                    select.append( '<option value="'+d+'">'+d+'</option>' )
	                } );
	            } );
	        }
	    } );
	} );
</script>