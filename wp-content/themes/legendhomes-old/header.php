<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title(''); ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/js/superfish/css/superfish.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/js/easyslider/css/screen.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" media="screen, print" />

	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/ie6.css" />
	<![endif]-->
		<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/ie7.css" />
	<![endif]-->
	
	<?php // google a/b test code if not home page
		if( !is_home() ) echo get_field( 'header_tracking' );
	?>

<?php wp_head(); // For plugins ?>
	<!--
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	-->
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<!-- Reference jQuery and jQuery UI from the CDN. Remember
       that the order of these two elements is important -->

<!-- smc
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

-->
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/superfish/js/superfish.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/superfish/js/supersubs.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/superfish/js/hoverIntent.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/site.js"></script>

	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/easyslider/js/easySlider1.7.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jcarousel/lib/jquery.jcarousel.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/js/jcarousel/skins/tango/skin.css" />

	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/galleria/galleria-1.2.5.js"></script>
	<script src="<?php bloginfo('template_directory') ?>/js/galleria/themes/classic/galleria.classic.js"></script>
	
	<script src="<?php bloginfo('template_directory') ?>/js/colorbox/jquery.colorbox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/js/colorbox/colorbox.css" />
<script type="text/javascript" src="/wp-content/themes/legendhomes/lunametrics-youtube-v5.js"></script>

<!-- Facebook Pixel Code -->
<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
_fbq.push(['addPixelId', '1031704943508610']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1031704943508610&amp;ev=PixelInitialized" /></noscript>
<!-- End Facebook Pixel Code -->

</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="site-container">
<noscript>
<div>
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1034400106/?value=300000&amp;label=pf5_CLbIlAIQ6uKe7QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- Google Code for Visits Any Page LH Remarketing List -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1034400106;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "666666";
var google_conversion_label = "1WsKCJa-kgIQ6uKe7QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>


<div id="wrapper" class="hfeed">

<div id="header">
		<div id="blog-title"><a href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?> - <?php bloginfo('description') ?>" rel="home">&nbsp;</a></div>
		<div id="social"><a href="/">Home</a> | <a href="/about-us/contact">Contact</a> | <a href="/realtors">Realtor Login</a>

		  <div id="linkycont"><a class="linky" href="http://www.facebook.com/LegendHomes" target="_blank" title="Legend Homes Facebook">&nbsp;</a><a class="linky" href="http://twitter.com/legendhomes" target="_blank" title="Legend Homes Twitter">&nbsp;</a><a class="linky" href="http://www.youtube.com/user/LegendHomesPDX" target="_blank" title="Legend Homes Youtube">&nbsp;</a><a class="linky" href="http://pinterest.com/legendhomes/" target="_blank" title="Legend Homes Pinterest Page">&nbsp;</a></div></div>
<div class="header-form1">        

<form action="http://edgemultimedia.createsend.com/t/y/s/btyihi/" method="post" id="subForm">

<table width="402" border="0" cellpadding="0" cellspacing="7">
<tr valign="top">

<td width="41" align="right"><label for="name">Name:</label></td>

<td width="108"><input type="text" name="cm-name" id="name" size="18" /></td>

<td width="225" rowspan="3"><strong>Stay Informed!</strong><br />

  Don't miss out on your dream home! Sign up for our newsletter for all our latest offerings.</td>

</tr>

<tr valign="top">

<td align="right"><label for="btyihi-btyihi">Email:</label></td>

<td><input type="text" name="cm-btyihi-btyihi" id="btyihi-btyihi" size="18" /></td>

</tr>
<tr valign="top">

<td></td>

<td><input type="submit" value=" Sign Up " /></td>

</tr>

</table>

</form>

</div>
		<?php 	
			wp_nav_menu( array(
				'container_id' => 'menu',
				'menu_class' => 'nav', 
				'theme_location' => 'primary' 
			) );
		?>

	</div><!--  #header -->
