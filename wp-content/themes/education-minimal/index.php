<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Education_Minimal
 */
get_header();
$sidebar = get_theme_mod('education_minimal_archive_setting_sidebar_option','sidebar-right');
?>
<div id="content" class="site-content inner-page-wrap">
	<div class="container">

	  	<div class="row">
		  	<?php 
				global $post;
				$custom_class = 'custom-col-8';
				if( 'sidebar-no' == $sidebar ){
					$custom_class = 'custom-col-12';
				} elseif ( 'sidebar-both' == $sidebar ) {
					$custom_class = 'custom-col-4';
				}else{
					$custom_class = 'custom-col-8';
				}
				if($sidebar=='sidebar-both' || $sidebar=='sidebar-left'){
					get_sidebar('left');
				}

			?> 	
			<div id="primary" class="content-area  <?php echo esc_attr( $custom_class );?>">

				<main id="main" class="site-main">

					<div class="select-bar-wrap">

						<div class="section-tabs">
							<ul>
								<li class="grid-view">
									<a href="javascript:void(0)" class="current">
									</a>
								</li>
								<li class="list-view">
									<a href="javascript:void(0)">
									</a>
								</li>
							</ul>
						</div>
						<div class="select  custom_select">
							<label><?php echo esc_html_e('Sort By:','education-minimal')?></label>
							<select name="slct" id="slct">
								<option value="date"><?php  esc_html_e('Date','education-minimal')?></option>
								<option value="author"><?php  esc_html_e('Author','education-minimal')?></option>
								<option value="rand"><?php  esc_html_e('Random','education-minimal')?></option>
								<option value="title"><?php esc_html_e('Title','education-minimal')?></option>
							</select>
						</div>
						<?php
							global 	$wp_query;
							$soring_query = array();	

							$wp_query_new = $wp_query->query_vars;

							$soring_query = json_encode($wp_query_new);
						?>
						<input id="sorting-query" type="hidden" name="sorting-query" value='<?php echo esc_attr($soring_query); ?>'/>
					
					</div><!--.select-bar-wrap-->
					<div class="tab-content">
						<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							do_action( 'education_minimal_action_navigation' );

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php
			if($sidebar=='sidebar-both' || $sidebar=='sidebar-right'){
				get_sidebar();
			}?>
			
		</div>
	</div>
</div>
<?php get_footer();