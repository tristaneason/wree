<?php
 /**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Minimal
 */
global $post;

if ( is_search()|| is_archive() || is_category() ){
	$post_class = get_theme_mod('education_minimal_archive_setting_sidebar_option','sidebar-right');
} elseif ( is_singular() ){
	$post_class =  get_post_meta( $post->ID, 'education_minimal_sidebar_layout', true );	
	if ( empty( $post_class ) ){
		$post_class = 'sidebar-left';
	}	
} else{
	$post_class = 'sidebar-left';
}
if ( 'sidebar-no' == $post_class || ! is_active_sidebar( 'education-minimal-sidebar-left' ) ) {
	return;
}

if( $post_class=='sidebar-left' || $post_class=='sidebar-both' ){ ?>
	<div id="secondary" class="custom-col-4">
		<?php if ( is_active_sidebar( 'education-minimal-sidebar-left' ) ) :
			dynamic_sidebar( 'education-minimal-sidebar-left' ); 
		endif; ?>
	</div>
<?php } ?>