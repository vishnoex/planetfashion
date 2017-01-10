<!DOCTYPE html>

<html lang="eng-us">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Planet Fashions</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="<?php echo ASSETS_URL?>images/icon/black_v.jpg">

	<!-- Google Webfont -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400|Crimson+Text' rel='stylesheet' type='text/css'>
	<!-- Themify Icons -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/themify-icons.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/bootstrap.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/owl.theme.default.min.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/magnific-popup.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/superfish.css">
	<!-- Easy Responsive Tabs -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/easy-responsive-tabs.css">

	<!-- Theme Style -->
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/style.css">
	<link rel="stylesheet" href="<?php echo ASSETS_URL?>css/style-edited.css">
	</head>
	<body>
		<?php include("stacked_header.php");?>
		<ul id="hiken-main">
			<?php echo $this->load->view($main_content)?>
			<?php include("footer.php");?>
		</ul>

		<!-- jQuery -->
		<script src="<?php echo ASSETS_URL?>js/jquery-1.10.2.min.js"></script>
		<!-- jQuery Easing -->
		<script src="<?php echo ASSETS_URL?>js/jquery.easing.1.3.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo ASSETS_URL?>js/bootstrap.js"></script>
		<!-- Owl carousel -->
		<script src="<?php echo ASSETS_URL?>js/owl.carousel.min.js"></script>
		<!-- Image Slider -->
		<script type="text/javascript" src="<?php echo ASSETS_URL?>js/responsiveCarousel.js"></script>
		<!-- Magnific Popup -->
		<script src="<?php echo ASSETS_URL?>js/jquery.magnific-popup.min.js"></script>
		<!-- Superfish -->
		<script src="<?php echo ASSETS_URL?>js/hoverIntent.js"></script>
		<script src="<?php echo ASSETS_URL?>js/superfish.js"></script>
		<!-- Easy Responsive Tabs -->
		<script src="<?php echo ASSETS_URL?>js/easyResponsiveTabs.js"></script>
		<!-- FastClick for Mobile/Tablets -->
		<script src="<?php echo ASSETS_URL?>js/fastclick.js"></script>
		<!-- Main JS -->
		<script src="<?php echo ASSETS_URL?>js/main.js"></script>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('.rfy-rate').carousel({ overflow: true, visible: 3, itemMinWidth: 200, itemMargin: 10 });
				$('.rfy-price').carousel({ overflow: true, visible: 2, itemMinWidth: 200, itemMargin: 10 });
			});
		</script>
	</body>
</html>