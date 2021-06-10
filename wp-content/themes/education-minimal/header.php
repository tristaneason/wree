<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Minimal
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-minimal' ); ?></a>
	<div class="overlay"></div>

	<header id="masthead" class="site-header">
		<?php 
		do_action('education_minimal_main_header_callback_action');	
			
		if( !is_home() && is_front_page()){
			do_action('education_minimal_slider_callback_action');
		} 
		?>
		<!-- Page breadcrumbs -->
		<?php 
		if(!is_home() && !is_front_page()){
		    do_action('education_minimal_title'); 
		}
		?>
	</header><!-- #masthead -->
	<?php 
	if(!is_home() && !is_front_page() && !is_404() ){ ?>
		<div id="content" class="site-content inner-page-wrap">
		<?php }else{ ?>
		<div id="content" class="site-content">
	<?php } ?>