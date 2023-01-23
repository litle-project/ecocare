
<script>
        $(document).ready(function(){
            $( "#from" ).datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: null,
                changeMonth: true,
                //minDate: 0,
                maxDate:0,
                numberOfMonths: 2,
                onClose: function( selectedDate ) {
                    $( "#to" ).datepicker( "option",  selectedDate );
                }
            });
            //jquery date picker configuration
            $( "#to" ).datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: null,
                changeMonth: true,
                //minDate: 0,
                maxDate:0,
                numberOfMonths: 2,
                onClose: function( selectedDate ) {
                    $( "#from" ).datepicker( "option",  selectedDate );
                }
            });
            
            $( "#dialog" ).dialog({
			autoOpen : false,
			modal : true,
			width : 500,
			open: function(){
				$('.ui-dialog-titlebar-close').addClass('ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only');
				$('.ui-dialog-titlebar-close').append('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span>');
			}
		});
            
            $('.detail').on('click',function(){
                    
			var url=$(this).attr("href");
                    
			//alert(url);
			$.get( ""+url+"",function( data ) {
			  $( "#book_det" ).html( data );
			  //alert(content_description);
			});
                    //$( "#dialog" ).append("aaaaaaaaaa");
                    $("#book_det").hide();
                    $("#book_det").fadeIn("3000");
                    
                    
                    //alert(p);
                    $( "#dialog" ).dialog("open");
		    return false;
		    
            });
        });
        
</script>


<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i><?php echo $title;?>
							</div>
							
						</div>
						<div class="portlet-body">
                                                        <form action="" method="post" class="form-horizontal" enctype='multipart/form-data'>
							<div class="form-body">
                                                            <?php
                                                                $style="style='display:none;'";
                                                                if($this->session->userdata("user_group_id")=="1"){    
                                                                    $style="";
                                                                }
                                                                $post=$this->input->post();
                                                                $branch_id ="";
                                                                $booking_start="";
                                                                $booking_end="";
                                                                if($this->input->post()):
                                                                    $branch_id =$post["branch_id"];
                                                                    $booking_start=$post["booking_start"];
                                                                    $booking_end=$post["booking_end"];
                                                                endif;
                                                            ?>
								<div class="form-group" <?php echo $style; ?>>
									<label class="col-md-3 control-label">Branch Name</label>
									<div class="col-md-4">
										<?php
											echo form_dropdown("branch_id",$branch,$branch_id,"class='form-control'");
										?>
									</div>
								</div>
                                                              
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Date Start</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="booking_start" id="from" value="<?php echo $booking_start ;?>" placeholder="Booking Start">
									
									</div>
								</div>
                                                                <div class="form-group">
									<label class="col-md-3 control-label">Date End</label>
									<div class="col-md-4">
										<input type="text" class="form-control" name="booking_end" id="to" value="<?php echo $booking_end ;?>" placeholder="Booking End">
									
									</div>
								</div>
                                                        </div>
                                                        <div class="form-actions fluid">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn blue">Search</button>
									<button type="reset" class="btn red">Reset</button>
								</div>
							</div>
                                                        </form>
							<div class="table-toolbar">
								<div class="btn-group">
									
								</div>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">Print</a>
										</li>
										<li>
											<a href="#">Save as PDF</a>
										</li>
										<li>
											<a href="#">Export to Excel</a>
										</li>
									</ul>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
								<tr>
									<th>No</th>
									<th>Member No</th>
									<th>Member Name</th>
									<th>Branch Name</th>
                                                                        <th>Status</th>
                                                                        <th>Detail</th>
									
									<th>Booking Date</th>
                                                                        <th>Booking Time</th>
                                                                        
                                                                        
								</tr>
							</thead>
							<tbody>
							<?php
								$no=1;
								foreach($get_data as $row){
							?>
							<tr class="odd gradeX">
								<td>
									<?php
										echo $no;
									?>
								</td>
								<td>
									<?php echo $row["member_no"];?>
								</td>
                                                                <td>
									<?php echo $row["member_name"];?>
								</td>
								<td>
									<?php echo $row["branch_name"];?>
								</td>
								<td>
									<?php  if($row["booking_status"]=="1"):
                                                                                echo "Present";
                                                                                else:
                                                                                echo "Un-Present";
                                                                                endif;
                                                                        ?>
								</td>
								<td>
									<a class="detail" href="<?php echo site_url("admin_booking/detail_booking?id=". $row["booking_id"] ."") ?>">Detail</a>
								</td>
                                                                
								<td>
									<?php echo $row["booking_date"];?>
								</td>
                                                                <td>
									<?php echo $row["booking_time"];?>
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
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>



<div id="dialog" title="Booking Detail">
	<div align="center" id="book_det" style="width:auto; display:none">
		a
	</div>
</div>
			<!-- END PAGE CONTENT -->