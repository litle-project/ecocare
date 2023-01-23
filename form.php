
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="assets/ico/favicon.png">

	<title>Menu - MyDynEd Dashboard</title>

	<!-- Javascript and Stylesheet -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/site/css/dashboard.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
         
	<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script> 
        <script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--<script type="text/javascript" src="assets/site/js/jquery.ui.sortable.js"></script>-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
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
				<a class="navbar-brand" href="#dashboard">Dashboard</a>
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
						<img src="http://icons.iconarchive.com/icons/double-j-design/origami-colored-pencil/256/blue-user-icon.png" class="img-polaroid" style="float: left; margin-right: 10px; height: 50px; width: 45px;">
						
                                                <strong>Administrator</strong><br>
                                                MyDynEd                                                
                                                <br>
						<a href="#logout">Logout</a>					</div>
				</div>
				
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
<!--						<li> <a href="#events"><span class="glyphicon glyphicon-tasks"></span> &nbsp; Events</a></li>-->
						<li> <a href="#resources"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Resource Pools</a></li>
                                                <li> <a href="#file_focus"><span class="glyphicon glyphicon-file"></span> &nbsp; File Focus</a></li>
						<li> <a href="#languages"><span class="glyphicon glyphicon-bullhorn"></span> &nbsp; Languages</a></li>
<!--						<li> <a href="#media_categories"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Media Categories</a></li>
						<li> <a href="#media_categories/list_categories/1"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Role Media Categories</a></li>-->
						<li> <a href="#media_files/by_category/1"><span class="glyphicon glyphicon-expand"></span> &nbsp; Media</a></li>
<!--						<li> <a href="#media_types"><span class="glyphicon glyphicon-credit-card"></span> &nbsp; Media Types</a></li>-->
						<li> <a href="#users"><span class="glyphicon glyphicon-user"></span> &nbsp; Users</a></li>
<!--						<li> <a href="#social_categories"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; Social Media Categories</a></li>-->
<!--						<li> <a href="#social_media"><span class="glyphicon glyphicon-comment"></span> &nbsp; Social Media</a></li>-->
						<li> <a href="#support"><span class="glyphicon glyphicon-headphones"></span> &nbsp; Support</a></li>
						<!-- <li> <a href="#application_os"><span class="glyphicon glyphicon-phone"></span> &nbsp; Application OS</a></li> -->
						<li> <a href="#applications"><span class="glyphicon glyphicon-phone"></span> &nbsp; Applications</a></li>
						<!-- <li> <a href="#application_temp"><span class="glyphicon glyphicon-qrcode"></span> &nbsp; Application Version</a></li> -->
						<li> <a href="#roles"><span class="glyphicon glyphicon-share"></span> &nbsp; Roles</a></li>
						<li> <a href="#menu"><span class="glyphicon glyphicon-th-list"></span> &nbsp; Menu</a></li>
<!--						<li> <a href="#menu/list_menu/1"><span class="glyphicon glyphicon-th-list"></span> &nbsp; Role Menu</a></li>-->
					</ul>
				</div>

				<div class="footer">
					&copy; 2014 DynEd International. All Rights reserved. Elapsed time 0.0443 secs with 2.43MB MB

				</div>

			</div>
			<div class="col-xs-12 col-lg-10">
				
								<script type="text/javascript">
function openKCFinder(field) {
        var containerKFCString = '<div id="containerKFC" style="position:fixed;background-color:rgba(0,0,0,0.3);top:0px;left:0px;width:100%;height:100%;" onClick="hideKCFFinder();">safasf</div>';
        $('body').append(containerKFCString);
        
        var div = document.getElementById('containerKFC');
	if (div.style.display == "block") {
		div.style.display = 'none';
		div.innerHTML = '';
		return;
	}
	window.KCFinder = {
		callBack: function(url) {
			window.KCFinder = null;
			field.value = url;
			div.style.display = 'none';
			div.innerHTML = '';
                        $('#containerKFC').remove();
		}
	};
	div.innerHTML = '<iframe name="kcfinder_iframe" src="http://cms.pistarlabs.net/kcfinder/browse.php?type=images" ' +
	'frameborder="0" width="80%" height="80%" marginwidth="0" marginheight="0" scrolling="no" style="max-width:800px;max-height:550px;position:absolute;margin: auto;top:0;left:0;right:0;bottom:0;"/>';
	div.style.display = 'block';
}
function hideKCFFinder()
{
    $('#containerKFC').remove();
}

</script>

<script type="text/javascript">
function openKCFinder_file(field) {
        var containerKFCString = '<div id="containerKFC" style="position:fixed;background-color:rgba(0,0,0,0.3);top:0px;left:0px;width:100%;height:100%;" onClick="hideKCFFinder();">safasf</div>';
        $('body').append(containerKFCString);
        
        var div = document.getElementById('containerKFC');
	if (div.style.display == "block") {
		div.style.display = 'none';
		div.innerHTML = '';
		return;
	}
	window.KCFinder = {
		callBack: function(url) {
			window.KCFinder = null;
			field.value = url;
			div.style.display = 'none';
			div.innerHTML = '';
                        $('#containerKFC').remove();
		}
	};
	div.innerHTML = '<iframe name="kcfinder_iframe" src="http://cms.pistarlabs.net/kcfinder/browse.php?type=files" ' +
	'frameborder="0" width="80%" height="80%" marginwidth="0" marginheight="0" scrolling="no" style="max-width:800px;max-height:550px;position:absolute;margin: auto;top:0;left:0;right:0;bottom:0;"/>';
	div.style.display = 'block';
}
function hideKCFFinder()
{
    $('#containerKFC').remove();
}

</script>


<form action="#media_files/create" role="form" method="post" accept-charset="utf-8"><div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				Media Files
			</div>
			<div class="box-content">
                                <ul class="nav nav-tabs">
                                    <li class="active"> <a href="#media_files/by_category/1">Media Files</a></li>
                                    <li> <a href="#media_types">Types</a></li>
                                    <li> <a href="#media_categories">Categories</a></li>
                                    <li> <a href="#media_categories/list_categories/1">Role for Categories</a></li>
                                </ul>
                                
                                
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-8">
								<div class="form-group">
									<label for="title">Title</label>
																		<input type="text" name="title" value="" class="form-control input-sm" id="user_id" />									<span class="help-block">Name</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-8">
								<div class="form-group">
									<label for="order_file">Order File</label>
																		<input type="text" name="order_file" value="" class="form-control input-sm" id="user_id" />									<span class="help-block">Order File</span>
								</div>
							</div>
						</div>
                                            
                                                <div class="row">
							<div class="col-xs-8">
								<div class="form-group">
									<label for="media_category_id">Media Category</label>
																		
                                                                        <select name="media_category_id" class="col-xs-12 form-control input-sm" id="country">
<option value="1" selected="selected">Brochures</option>
<option value="6">Contract</option>
<option value="35">Correlations</option>
<option value="15">Course Leaflet</option>
<option value="12">General</option>
<option value="32">Installation Guides</option>
<option value="36">Matrix</option>
<option value="33">Network Requirements</option>
<option value="9">Parent Presentation</option>
<option value="14">Podcasts</option>
<option value="13">Product</option>
<option value="38">Product Map</option>
<option value="31">RM Guides</option>
<option value="7">Sales Presentation</option>
<option value="11">Student</option>
<option value="24">Student Orientation Videos</option>
<option value="4">Study Guides</option>
<option value="10">Teacher</option>
<option value="28">Teacher Guides</option>
<option value="8">Teacher Presentation</option>
<option value="39">Training Videos</option>
<option value="30">User Guides</option>
<option value="16">Videos</option>
<option value="34">White Papers</option>
<option value="37">WIDA</option>
</select>                                                                        
                                                                        <span class="help-block">Media Category</span>
								</div>
							</div>
						</div>
                                            
                                                <div class="row">
							<div class="col-xs-8">
								<div class="form-group">
									<label for="file_focus_id">File Focus</label>
																		
                                                                        <select name="file_focus_id" class="col-xs-12 form-control input-sm" id="country">
<option value="1">Corporate</option>
<option value="2">General</option>
<option value="3">Solutions</option>
<option value="4">Mobile</option>
<option value="5">New Dynamic English</option>
<option value="6">The Lost Secret</option>
<option value="7">English by the Numbers</option>
<option value="8">English for Success</option>
<option value="9">Reading for Success</option>
<option value="10">First English</option>
<option value="11">DynEd Kids</option>
<option value="12">Let's Go</option>
<option value="13">Advanced Listening</option>
<option value="14">Dynamic Business English</option>
<option value="15">Functioning in Business</option>
<option value="16">Hospitality English</option>
<option value="17">Aviation English Pilots</option>
<option value="18">Aviation English for ATC</option>
<option value="19">Clear Speech Works</option>
<option value="20">Test Mountain</option>
<option value="22">Record Keeping</option>
<option value="23">Aviation English for Cabin Crew</option>
<option value="24">Aviation English </option>
<option value="26">Dialogue</option>
</select>                                                                        
                                                                        <span class="help-block">File Focus</span>
								</div>
							</div>
						</div>
                                            
                                                <div class="row">
							<div class="col-xs-8">
								<div class="form-group">
									<label for="language_id">Language</label>
																		
                                                                        <select name="language_id" class="col-xs-12 form-control input-sm" id="country">
<option value="1">English</option>
<option value="2">Chinese</option>
<option value="3">Spanish</option>
<option value="4">Turkish</option>
<option value="5">Portuguese</option>
<option value="6">Japanese</option>
<option value="7">Indonesian</option>
<option value="8">Czech Repulic</option>
<option value="9">Italian</option>
<option value="10">Other</option>
</select>                                                                        
                                                                        <span class="help-block">Language</span>
								</div>
							</div>
						</div>
                                            
                                            <div class="form-group">
							<label for="description">Description</label>
														<textarea name="description" cols="40" rows="10" class="form-control input-sm ckeditor" id="description"></textarea>							<span class="help-block">Description of media_file. </span>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
								<label for="telp">Upload File</label>
																<input type="text" name="path" value="" class="form-control input-sm" id="path"onclick="openKCFinder_file(this)" />								<span class="help-block">Upload File</span>
						</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
								<label for="thumbnail">Upload Thumbnail</label>
																<input type="text" name="thumbnail" value="" class="form-control input-sm" id="thumbnail"onclick="openKCFinder(this)" />								<span class="help-block">Upload Thumbnail</span>
						</div>
                                            </div>

												<input type="submit" name="__submit" value="Submit" class="btn btn-primary" />                                                <a href="#media_files/index" class="btn btn-danger ">Cancel</a>
                                        </div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</form>			</div>
		</div>

		

	</div>

	<!-- Javascript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function confirm_delete() {
			return confirm("Are you sure you want to delete this entry?");
		}
	</script>
        <script src="http://cms.pistarlabs.net/ckeditor/ckeditor.js"></script>
        </body>
</html>
