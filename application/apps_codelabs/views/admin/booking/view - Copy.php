<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<style>
	#loading {
		position: absolute;
		
		text-align:center;
		top:400px;
		left:800px;
		
		}

	#calendar {
		width: 1000px;
		margin: 0 auto;
		}

</style>
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
					
					
					
						<div id='loading' style='display:none'>loading...</div>
						<div id='calendar'></div>
														
					
					
					
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT -->


<script src='<?php echo base_url();?>assets/lib/jquery.min.js'></script>
<script src='<?php echo base_url();?>assets/lib/jquery-ui.custom.min.js'></script>
<script src='<?php echo base_url();?>assets/fullcalendar/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: false,
			
			events: "<?php echo site_url("admin_booking/get_booking");?>",
			
			/*
			eventDrop: function(event, delta) {
				alert(event.title + ' was moved ' + delta + ' days\n' +
					'(should probably update your database)');
			},
			*/
			
			eventRender: function (event, element) {
				element.attr('href', 'javascript:void(0);');
				element.attr('onclick', 'openModal("' + event.title + '","' + event.description + '","' + event.url + '");');
			},
			
			eventClick: function(event) {
				if (event.title) {
					window.open("google.com");
					return false;
				}
			},
			
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			
		});
		
	});
	
	function openModal(title, info, url) {
		$("#eventInfo").html(info);
		$("#eventLink").attr('href', url);
		$("#eventContent").dialog({ modal: true, title: title });
	}

</script>

<div id="eventContent" title="Event Details">
    <div id="eventInfo"></div>
    <p><strong><a id="eventLink" target="_blank">Read More</a></strong></p>
</div>