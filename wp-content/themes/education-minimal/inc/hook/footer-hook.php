<?php
/**
 * Education Minimal Footer Functions And Definations
 *
 * @package Education_Minimal
 */
 function education_minimal_footer_hook_callback(){
?>
	<footer id="colophon" class="site-footer">
		<?php if (get_theme_mod('education_minimal_top_footer_option','no')=='yes') {  ?>
		<div class="newsletter-section" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_footer_bg_image')); ?>') ";>
			<div class="container">
				<div class="row">
	                <div class="custom-col-4">
	                	<?php dynamic_sidebar( 'education-minimal-top-footer' );?>
	                </div>
	                <div class="custom-col-8 subscribe">
	                	<?php dynamic_sidebar( 'education-minimal-top-two-footer' );?>
	                </div>
                </div>
			</div>
		</div>
		<?php } ?>
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="footer-mid default-padding">

				<div class="container">

					<div class="row">
						<?php
						$column_count = 0;
						$class_coloumn =12;
						for ( $i = 1; $i <= 4; $i++ ) {
							if ( is_active_sidebar( 'footer-' . $i ) ) {
								$column_count++;
								$class_coloumn = 12/$column_count;
							}
						} ?>
						<?php $column_class = 'custom-col-' . absint( $class_coloumn );

						for ( $i = 1; $i <= 4 ; $i++ ) {
							if ( is_active_sidebar( 'footer-' . $i ) ) { ?>
								<div class="<?php echo esc_attr( $column_class ); ?>">
									<?php dynamic_sidebar( 'footer-' . $i ); ?>
								</div>
							<?php }
						}
						?>
					</div>
				</div>
			</div>
			<?php endif;?> 
		<div class="site-generator">
			<div class="container">
				<span class="copy-right">
					<span class="copy-right"><?php echo esc_html( get_theme_mod( 'education_minimal_copyright_text',esc_html__('2019 Education Minimal','education-minimal')));?>
					</span>
					<?php 
					printf( esc_html__( 'Education Minimal by %1$s.', 'education-minimal' ), '<a href="'.esc_url( 'https://rigorousthemes.com' ).'" rel="designer">'.esc_html__('Rigorous Themes', 'education-minimal').'</a>' ); ?>
				</span>
			</div>
		</div>

	</footer><!-- #colophon -->
	<?php do_action('education_minimal_footer_last_callback_action'); ?>
<?php	
}
add_action('education_minimal_footer_callback_action','education_minimal_footer_hook_callback');