<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $seo[0]["title"]; ?></title>
	<meta name="description" content="<?php echo $seo[0]["description"]; ?>">
	<meta name="keywords" content="<?php echo $seo[0]["keyword"]; ?>">
	<meta name="author" content="codelabs.co.id">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php echo  base_url(); ?>home/css/style.css" type="text/css"  media="all">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900|Roboto|Roboto+Slab:300,400' rel='stylesheet' type='text/css'>

	<!-- JS
  ================================================== -->
   <script type="text/javascript" src="<?php echo  base_url(); ?>home/js/jquery.min.js" ></script>
	<!--[if lt IE 9]>
	<script src="<?php echo  base_url(); ?>home/js/modernizr.custom.11889.js" type="text/javascript"></script>
	<![endif]-->
		<!-- HTML5 Shiv events (end)-->
    <script type="text/javascript" src="<?php echo  base_url(); ?>home/js/nav-resp.js"></script>
	<!-- Favicons
  ================================================== -->
	<link rel="shortcut icon" href="<?php echo  base_url(); ?>home/images/favicon.ico">

    </head>
<body>

	<!-- Primary Page Layout
	================================================== -->

<div id="wrap" class="colorskin-0">
<!--<div class="top-bar">
		
<div class="container">
<div class="top-links"> <a href="#">Form</a> | <a href="#">Terms</a> | <a href="#">Contact</a></div>
<div class="socailfollow"><a href="#" class="facebook"><i class="icomoon-facebook"></i></a> <a href="#" class="dribble"><i class="icomoon-dribbble"></i></a>  <a href="#" class="vimeo"><i class="icomoon-vimeo"></i></a><a href="#" class="google"><i class="icomoon-google"></i></a> <a href="#" class="twitter"><i class="icomoon-twitter"></i></a></div>

</div>
</div>-->
<div id="sticker">
<header id="header">
<div  class="container">
<div class="four columns logo"><a href="index.html"><img src="<?php echo  base_url(); ?>media/config/<?php echo $config[0]["logo"]; ?>" width="120" id="img-logo" alt="logo"></a></div>


<nav id="nav-wrap" class="nav-wrap1 twelve columns">
				<!--<div id="search-form">
					<form action="#" method="get">
						<input type="text" class="search-text-box" id="search-box">
					</form>
				</div>-->
					<?php
						$this->load->view("home_menu");
					?>
</nav>
		<!-- /nav-wrap -->
</div>
				<!--
				<div id="search-form2">
					<form action="#" method="get">
						<input type="text" class="search-text-box2">
					</form>
				</div>
				-->
</header>
<!-- end-header -->
</div>
<!-- end-sticker -->
  <section id="hero" class="tbg1">
    <div id="layerslider-container-fw">
      <div id="layerslider" style="width: 100%; height: 436px; margin: 0px auto; ">
		<?php $this->load->view("slider");?> 	   
      </div>
    </div>
  </section>
  <!-- end-hero-->

<section id="headline">
    <div class="container">
      <h3>Blog<small> Left Sidebar</small></h3>
    </div>
  </section>

  <section class="container page-content" >
    <hr class="vertical-space2">
    <aside class="four columns sidebar leftside">
      <h4 class="subtitle">Categories</h4>
      <div class="listbox1">
        <ul>
          <li><a href="#">Company </a></li>
          <li><a href="#">News</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Other </a></li>
        </ul>
      </div>
      <!-- end-listbox1 -->
      <br class="clear">
      <h4 class="subtitle">Text Widget</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor<a href="#"> exercitation</a> ut labore et dolore magna aliqua. Ut enim ad</p>
      <br class="clear">
      <h4 class="subtitle">Archives</h4>
      <div class="listbox1">
        <ul>
          <li><a href="#">May 2012 (2)</a></li>
          <li><a href="#">April 2012 (3)</a></li>
          <li><a href="#">March 2012 (5)</a></li>
          <li><a href="#">February 2012 (1) </a></li>
        </ul>
      </div>
      <!-- end-listbox1 -->
      <br class="clear">
      <h4 class="subtitle">Tags</h4>
      <div class="tagcloud"> <a href="#">Design</a> <a href="#">vestibulum</a> <a href="#">Web</a> <a href="#">hosting</a> <a href="#">domain</a> <a href="#">HTML</a> <a href="#">vestibulum</a> <a href="#">Web</a> <a href="#">hosting</a> <a href="#">domain</a> <a href="#">CSS</a> <a href="#">vestibulum</a> <a href="#">Web</a> <a href="#">hosting</a> <a href="#">domain</a> <a href="#">Link</a> <a href="#">vestibulum</a> <a href="#">Web</a> <a href="#">hosting</a> <a href="#">domain</a> </div>
    </aside>
    <!-- end-sidebar-->
    <section class="eleven columns">
        
        
      <?php
        $this->load->view("home_1/" . $page);
      ?>
	
      
      
      
      <br class="clear">
      <!--<div class="pagination2 pagination2-centered">
        <ul>
          <li class="disabled"><a href="#">&laquo;</a></li>
          <li class="active"><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
      </div>-->
      <div class="vertical-space2"></div>
    </section>
    <!-- end-main-content -->
    <br class="clear">
  </section>
  <!-- container -->
    <footer id="footer">
    <section class="container footer-in">
	      <div class="one-third column contact-inf">
        <h4 class="subtitle">Contact Information</h4>
        <br />
        <p><strong>Address: </strong> No.28 - 63739 street lorem ipsum City, Country</p>
        <p><strong>Phone: </strong> + 1 (234) 567 8901 </p>
        <p><strong>Fax: </strong> + 1 (234) 567 8901 </p>
        <p><strong>Email: </strong> support@yoursite.com </p>
		<h4 class="subtitle">Stay Connected</h4>
		        <div class="socailfollow"><a href="#" class="facebook"><i class="icomoon-facebook"></i></a> <a href="#" class="dribble"><i class="icomoon-dribbble"></i></a> <a href="#" class="pinterest"><i class="icomoon-pinterest-2" aria-hidden="true"></i></a> <a href="#" class="vimeo"><i class="icomoon-vimeo"></i></a><a href="#" class="google"><i class="icomoon-google"></i></a> <a href="#" class="twitter"><i class="icomoon-twitter"></i></a> <a href="#" class="youtube"><i class="icomoon-youtube"></i></a> </div>
      </div>
      <!-- end-contact-info /end -->

      <div class="one-third column">
        <h4 class="subtitle">latest tweet</h4>
        <br />
        <div class="lts-tweets">
		<i class="icomoon-twitter"></i>
		<h3><a href="https://twitter.com/webnus">@webnus</a></h3>
		<h5 id="twitter"></h5>
        </div>
      </div>
      <!-- tweets  /end -->
	  
	  <div class="one-third column">
        <h4 class="subtitle">flickr photostream</h4>
        <br />
        <div class="flickr-feed">
          <script type="text/javascript" src="http://www.flickr.com/badge_code.gne?count=12&amp;display=random&amp;size=square&amp;nsid=36587311@N08&amp;raw=1"></script>
          <div class="clear"></div>
        </div>
      </div>
      <!-- flickr /end -->
	   </section>
    <!-- end-footer-in -->
    <section class="footbot">
	<div class="container">
      <div class="footer-navi">© <?php echo date("Y");?>. <?php echo $config[0]["footer_desc"]; ?>  </div>
	  <!-- footer-navigation /end -->
      <img src="<?php echo  base_url(); ?>media/config/<?php echo $config[0]["logo"]; ?>" width="65" alt="">	  </div>
	  </section>
    <!-- end-footbot -->
  </footer>
<!-- end-footer -->
<span id="scroll-top"><a class="scrollup"><i class="icomoon-arrow-up"></i></a></span>
</div><!-- end-wrap -->


<!-- End Document
================================================== -->
<script type="text/javascript" src="<?php echo  base_url(); ?>home/js/jcarousel.js" ></script>
<script type="text/javascript" src="<?php echo  base_url(); ?>home/js/mexin-custom.js" ></script>
<script type="text/javascript" src="<?php echo  base_url(); ?>home/js/doubletaptogo.js" ></script>
<script src="<?php echo  base_url(); ?>home/layerslider/jQuery/jquery-easing-1.3.js" type="text/javascript"></script>
<script src="<?php echo  base_url(); ?>home/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo  base_url(); ?>home/js/layerslider-init.js"></script>
<script type="text/javascript" src="<?php echo  base_url(); ?>home/js/jquery.sticky.js"></script>
<script src="<?php echo  base_url(); ?>home/js/bootstrap-alert.js"></script>
<script src="<?php echo  base_url(); ?>home/js/bootstrap-dropdown.js"></script>
<script src="<?php echo  base_url(); ?>home/js/bootstrap-tab.js"></script>
</body>
</html>