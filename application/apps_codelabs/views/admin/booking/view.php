	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/calendar/css/eventCalendar.css">

	<link rel="stylesheet" href="<?php echo base_url()?>assets/calendar/css/eventCalendar_theme_responsive.css">	
	<style>
		.eventsCalendar-day-header{
			font-size:12px !important;
		
		}
		.empty{
			min-height:70px !important;		
		}
	
		.eventsCalendar-day a{
			min-height:70px !important;
			font-size:12px !important;
			padding-top:20px !important;
		}
		
		.eventsCalendar-day .empty{
			height:70px !important;
		}
		
		#eventCalendarScroll{
			height:800px !important;
		}
		
		.eventsCalendar-list-content{
			height:300px !important;
		}
		
		.eventDesc{
			font-size:12px !important;
		}
		.eventDesc b{
			text-decoration:bold !important;
		}
		
		
	</style>
	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/calendar/css/eventCalendar_theme_responsive.css">
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
					
					
					
				<div id="eventCalendarScroll"></div>

														
					
					
					<?php
					//$now = date("Y-m-d");
					//$newdate = date("Y-m-d",strtotime ( '+2 week' , strtotime ( $now ) ) ) ;
				//	echo $newdate;
			
					?>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT -->


<script src="<?php echo base_url();?>assets/calendar/js/jquery.eventCalendar.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		//alert("a");
		$("#eventCalendarScroll").eventCalendar({
			eventsjson: '<?php echo site_url("admin_booking/json_booking");?>',
			eventsScrollable: true,
			jsonDateFormat: 'human',
			startWeekOnMonday: false,
			showDescription: true
		});
		/*
		$("a").on("click",function(){
			//alert("a");
			$( "#dialog" ).dialog("open");
			console.log("click");
		});
		*/
		
		$( "#dialog" ).dialog({
			autoOpen 	: false,
			modal		: true,
			width		: "500",
			height		: "500",
			open: function(){
				$('.ui-dialog-titlebar-close').addClass('ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only');
				$('.ui-dialog-titlebar-close').append('<span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span>');
			},
		});
	});
</script>
<div id="dialog" title="Booking Detail">
	<div align="center" id="book_det" style="width:auto; display:none">
		
	</div>
</div>
