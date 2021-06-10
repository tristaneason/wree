<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Education_Minimal
 */
get_header();
?>

	<div id="content" class="site-content">

		<div id="primary">
			<main id="main" class="site-main">

				<div class="error-404 not-found" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_404_bg_image',get_template_directory_uri().'/assets/img/mistake.jpg')); ?>') ";>
					
					<div class="container">
						<h2><?php  esc_html_e('404','education-minimal')?></h2>
						<h4>
							<?php  esc_html_e('Page Not Found','education-minimal')?>
						</h4>
						 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><?php echo esc_html__('back to home','education-minimal') ?></a>
					</div>

				</div>

			</main><!--.site-main-->
		</div><!--#primary-->

	</div><!--.site-content-->
<?php
get_footer();