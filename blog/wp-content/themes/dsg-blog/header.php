<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '-', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
		?></title>
		
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="/favicon.ico">

		<!-- default stylesheet -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/normalize.css">		
		
		<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script>window.jQuery || document.write(unescape('%3Cscript src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script>
		
		<!-- drop Google Analytics Here -->
		<!-- end analytics -->
		
		<!-- modernizr -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/modernizr.full.min.js"></script>
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="container">
			
			<header role="banner">
			
				<div id="inner-header" class="clearfix">
					
					<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
					<a href="/" rel="nofollow"><img src="/blog/wp-content/images/dsg_logo.png" alt="<?php bloginfo('description'); ?>" /></a>
					
					<img id="tagline" alt="Absolute Excellence" src="/blog/wp-content/images/tagline.png">
					
					<div id="social">
					  <a target="_blank" href="http://www.facebook.com/#!/pages/DSG-Auto-Contracts-Ltd/216316921738028"><img alt="Join us on Facebook" src="/blog/wp-content/images/facebook.png"></a><a target="_blank" href="http://www.twitter.com/dsgautocontract"><img alt="Follow us on Twitter" src="/blog/wp-content/images/twitter.png"></a>
					</div>
					
					<div id="header_contact">
					  <h2>0161 406 3936</h2> 
					  <hr>
					  <h3>MON-FRI  9am-5:30pm</h3> 
					</div>
					
					<nav role="navigation">
						<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->
