<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>
		
		<!-- Added by Tareq Starts -->
			<style>
	.tareq_mi {
		border: none;
		height: auto;
		max-width: 100%;
		width: auto;
	}
	</style>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://mattstow.com/experiment/responsive-image-maps/jquery.rwdImageMaps.min.js"></script>
<script type="text/javascript" src="https://projects.davidlynch.org/maphilight/jquery.maphilight.js"></script>
	<!-- Added by Tareq Ends -->
	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="wrap cf">

					<div class="title-container">

						<p id="logo" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><span class="splossary-s">s</span><span class="splossary-p">p</span>lsry<sup>&trade;</sup><?php //bloginfo('name'); ?></a></p>

						<?php //get_search_form(); ?>

					</div>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>

					<nav id="main-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    					         'menu_class' => 'nav top-nav cf',               // adding custom nav class
    					         'theme_location' => 'main-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>

					</nav>

					<nav id="mobile-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

						<a class="mobile-menu-btn" onclick="open_nav()"></a>

						<div class="mobile-menu-itms" id="mobile-menu-itms" style="display: none;">

							<a class="close-mobile-menu-btn" onclick="close_nav()">×</a>

							<?php wp_nav_menu(array(
									'container' => false,                           // remove nav container
									'container_class' => 'menu cf',                 // class of container (should you choose to use it)
									'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
									'menu_class' => 'nav top-nav cf',               // adding custom nav class
									'theme_location' => 'main-nav',                 // where it's located in the theme
									'before' => '',                                 // before the menu
									'after' => '',                                  // after the menu
									'link_before' => '',                            // before each link
									'link_after' => '',                             // after each link
									'depth' => 0,                                   // limit the depth of the nav
									'fallback_cb' => ''                             // fallback function (if there is one)
							)); ?>

						</div>

						<?php get_search_form(); ?>

					</nav>

				</div>

			</header>
