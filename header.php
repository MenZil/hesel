<!DOCTYPE HTML>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		<?php if ( is_home() ) { ?>
		<?php bloginfo('name'); ?>|
		<?php bloginfo('description'); ?>
		<?php } ?>
		<?php if ( is_search() ) { ?>
		ئىزدەش نەتىجىسى |
		<?php bloginfo('name'); ?>
		<?php } ?>
		<?php if ( is_single() ) { ?>
		<?php echo trim(wp_title('',0)); ?>|
		<?php bloginfo('name'); ?>
		<?php } ?>
		<?php if ( is_page() ) { ?>
		<?php echo trim(wp_title('',0)); ?>|
		<?php bloginfo('name'); ?>
		<?php } ?>
		<?php if ( is_category() ) { ?>
		<?php single_cat_title(); ?>|
		<?php bloginfo('name'); ?>
		<?php } ?>
		<?php if ( is_month() ) { ?>
		<?php the_time('F'); ?>|
		<?php bloginfo('name'); ?>
		<?php } ?>
		<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
		<?php  single_tag_title("", true); ?>|
		<?php bloginfo('name'); ?>
		<?php } ?>
		<?php } ?>
	</title>

	<link href="<?php bloginfo('template_directory'); ?>/style.css?ver=1.012" rel="stylesheet" type="text/css" media="all"/>

	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
	<?php wp_head(); ?>
</head>
<body>
	<div class="header" id="home">  	   
		<div class="header_top">
			<div class="wrap">	      	   
				<div class="logo">
					<a href="<?php bloginfo( 'url' ) ?>">

						<?php if (get_option('swt_logo')!= "") { ?>
						<img width="100%" src="<?php echo get_option('swt_logo'); ?>" alt="<?php bloginfo( 'name' ) ?>"/>
						<?php }else{?>
						<img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ) ?>" /> 
						<?php }?>
					</a>

				</div>	
				<div class="menu">
					<a class="toggleMenu" href="#"><img src="<?php bloginfo('template_directory'); ?>/images/nav.png" alt="" /></a>
					<ul class="nav" id="nav">
						<?php wp_nav_menu( array('theme_location'=>'top-menu','container'=>'','items_wrap'=>'%3$s','fallback_cb'=>'AJI_nav_fallback')); ?>						
						<div class="clear"></div>
					</ul>
					<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/responsive-nav.js"></script>
				</div>							
				<div class="clear"></div>
			</div>
		</div>
	</div>		      	
		<div class="main">
			<div class="content">	
				<div class="wrap">
