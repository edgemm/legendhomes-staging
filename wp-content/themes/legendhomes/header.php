<?php

require_once( locate_template( "inc/mobile_detect.php" ) );
$detect = new Mobile_Detect;

$mobile_class = ( $detect->isMobile() ) ? "isMobile" : "notMobile";

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script type="text/javascript">
		// conditionizr.com
		// configure environment tests
		conditionizr.config({
		    assets: '<?php echo get_template_directory_uri(); ?>',
		    tests: {}
		});
		</script>

	</head>
	<body <?php body_class( $mobile_class ); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<header class="header clear" role="banner">
				
				<div id="masthead" class="clear">
					
					<div class="container">

						<div class="logo">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" class="logo-img" alt="">
							</a>
						</div>
						<!-- /logo -->

						<label for="nav-expand" class="nav-trigger img-replace">Menu</label>
						<input type="radio" name="nav" id="nav-expand" class="nav-toggle" />
						<label for="nav-collapse" class="nav-collapse nav-toggle img-replace"></label>
						<input type="radio" name="nav" id="nav-collapse" class="nav-toggle" />
	
	
						<nav id="nav" class="nav" role="navigation">
							<?php edgemm_main_nav(); ?>
						</nav>
						<!-- /nav -->

					</div>

				</div>

			</header>
			<!-- /header -->
