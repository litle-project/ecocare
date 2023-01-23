
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="<?php echo $this->session->userdata("web_desc");?>">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title><?php echo $this->session->userdata("web_title");?></title>

	<!-- Javascript and Stylesheet -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo  base_url();?>assets/site/css/dashboard.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
         
	<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script> 
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--<script type="text/javascript" src="assets/site/js/jquery.ui.sortable.js"></script>-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		
		
		
	
<link href="<?php echo  base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css"/>
	<!-- BEGIN THEME STYLES -->
	
	<link href="<?php echo  base_url();?>assets/css/style-codelabs.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo  base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo  base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo  base_url();?>assets/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END THEME STYLES -->
		<script>
			$(document).ready( function () {
			  var table = $('#sample_editable_1').DataTable();
			} );
		</script>
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $this->session->userdata("web_url");?>">Dashboard</a>
			</div>
			<!-- <div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">Home</a></li>
					<li><a href="#dashboard/assessment">Assessment</a></li>
					<li><a href="#">Solutions</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">View Site</a></li>
				</ul>
			</div> --><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container-fluid">

		<div class="row">
			<div class="col-xs-12 col-lg-2">
				
				<div class="box">
					<div class="box-content">
						
                                                <strong><?php echo $this->session->userdata("admin_name");?></strong><br>
                                                					</div>
				</div>
				
				
					<div class="page-sidebar-wrapper">
						
						<div class="box">
							<div class="box-content">
								<img src="<?php echo base_url();?>media/user/<?php echo $this->session->userdata("admin_photo");?>" class="img-polaroid" style="float: left; margin-right: 10px; height: 50px; width: 45px;">
								
								<strong><?php echo $this->session->userdata("admin_name");?></strong><br>
								<?php echo $this->session->userdata("web_name");?>                                                
								<br>
								<a href="<?php echo site_url("login_admin/logout"); ?>">Logout</a>
							</div>
						</div>
						
						
						
					    <?php
                                                    $this->load->view("admin_menu");
                                            ?>
                                            
					
	</div>
				

				<div class="footer">
					&copy; <?php echo date("Y");?> <?php echo $this->session->userdata("footer_desc");?> Elapsed time {elapsed_time} secs with {memory_usage} MB

				</div>

			</div>
			<div class="col-xs-12 col-lg-10">
				
								<div class="box">
	<div class="box-header">
		Menu
	</div>
	<div class="box-content">
		
                <?php
                        $this->load->view("admin/$page");
                ?>
		<!--
		<a href="#menu/add" class="btn btn-success btn-sm pull-right" style="margin-bottom: 10px; margin-top: 10px;">Add New</a>
		
						
		<table></table>
		<div class="portlet-body">
			<div class="table-responsive">
				<table class="table table-bordered">
				<thead>
				<tr>
					<th>
						#
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
					<th>
						Table heading
					</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						1
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
				</tr>
				<tr>
					<td>
						2
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
				</tr>
				<tr>
					<td>
						3
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
					<td>
						Table cell
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>-->
		
		
		
		
	</div>
</div>			</div>
		</div>

		

	</div>

	<!-- Javascript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	
        <script type="text/javascript">
		function confirm_delete() {
			return confirm("Are you sure you want to delete this entry?");
		}
	</script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
	<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/excanvas.min.js"></script>
<![endif]-->

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<!--<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- END CORE PLUGINS -->

<script src="<?php echo base_url();?>assets/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/table-editable.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   
   
});

</script>
<!--<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>-->

        </body>
</html>
