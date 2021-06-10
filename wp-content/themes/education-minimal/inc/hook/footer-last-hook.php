<?php
/**
 * Education Minimal Footer Functions And Definations
 *
 * @package Education_Minimal
 */

 function education_minimal_footer_last_hook_callback(){
?>
<?php 
	if (get_theme_mod('education_minimal_last_footer_option','no')=='yes') {  ?>
<div class="enroll-section" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_footer_background_image')); ?>') ";>
		<div class="container">

			<div class="row">

				<?php
					$footer_page  = get_theme_mod('education_minimal_footer_one_page');
					$footer_one_url = get_theme_mod( 'education_minimal_footer_page_link_one', esc_url( home_url( '/' ).'#focus' ) );	
				 ?>

				<!-- ************************** Footer Title and Features Image First  *****************-->
				<?php   if( !empty( $footer_page ) ): 

				$args = array (                                 
				'page_id'           => absint( $footer_page ),
				'post_status'       => 'publish',
				'post_type'         => 'page',
				);

				$loop = new WP_Query($args);

				if ( $loop->have_posts() ) : ?>	

					<div class="custom-col-3">

						<?php while ($loop->have_posts()) : $loop->the_post();?>

							<div class="enroll-item">

								<?php if( ( $footer_one_url ) ) { ?>

									<a href="<?php echo esc_url($footer_one_url); ?>">
										<span class="enroll-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<h4 class="enrol-title"><?php the_title(); ?></h4>
									</a>
								<?php } else{ ?>

									<a href="<?php the_permalink(); ?>">
										<span class="enroll-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<h4 class="enrol-title"><?php the_title(); ?></h4>
									</a>

								<?php } ?>	
							</div>

						<?php endwhile; 
						wp_reset_postdata();?>	
					</div>

				<?php endif;

				endif;

				?> 

				<?php $footer_two_page  = get_theme_mod('education_minimal_footer_two_page');
				$footer_two_url = get_theme_mod( 'education_minimal_footer_page_link_two', esc_url( home_url( '/' ).'#focus' ) );	
				 ?>

				<!-- ************************** Footer Title and Features Image First  *****************-->

				<?php   if( !empty( $footer_two_page ) ): 

				$args = array (                                 
					'page_id'           => absint( $footer_two_page ),
					'post_status'       => 'publish',
					'post_type'         => 'page',
				);

				$loop = new WP_Query($args);

				if ( $loop->have_posts() ) : ?>	

					<div class="custom-col-3">
						<?php while ($loop->have_posts()) : $loop->the_post();?>
							<div class="enroll-item">
								<?php if( ( $footer_two_url ) ) { ?>

									<a href="<?php echo esc_url($footer_two_url); ?>">
										<span class="enroll-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<h4 class="enrol-title"><?php the_title(); ?></h4>
									</a>
								<?php } else{ ?>
									<a href="<?php the_permalink(); ?>">
										<span class="enroll-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<h4 class="enrol-title"><?php the_title(); ?></h4>
									</a>
								<?php } ?>
							</div>
						<?php endwhile; 
						wp_reset_postdata();?>
					</div>

				<?php endif;

				endif;

				?> 

				<?php $footer_three_page  = get_theme_mod('education_minimal_footer_three_page'); 
				$footer_three_url = get_theme_mod( 'education_minimal_footer_page_link_three', esc_url( home_url( '/' ).'#focus' ) );	
				?>

				<!-- ************************** Footer Title and Features Image First  *****************-->

				<?php   if( !empty( $footer_three_page ) ): 

				$args = array (                                 
					'page_id'           => absint( $footer_three_page ),
					'post_status'       => 'publish',
					'post_type'         => 'page',
				);

				$loop = new WP_Query($args);

				if ( $loop->have_posts() ) : ?>	

					<div class="custom-col-3">
						<?php while ($loop->have_posts()) : $loop->the_post();?>
							<div class="enroll-item">
								<?php if( ( $footer_three_url ) ) { ?>

									<a href="<?php echo esc_url($footer_three_url); ?>">
										<span class="enroll-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<h4 class="enrol-title"><?php the_title(); ?></h4>
									</a>
								<?php } else{ ?>
									<a href="<?php the_permalink(); ?>">
										<span class="enroll-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<h4 class="enrol-title"><?php the_title(); ?></h4>
									</a>
								<?php } ?>
							</div>
						<?php endwhile; 
						wp_reset_postdata();?>
					</div>
					<?php endif;

				endif;

				?> 

				<?php 
				$footer_four_page  = get_theme_mod('education_minimal_footer_four_page');
				$footer_four_url = get_theme_mod( 'education_minimal_footer_page_link_four', esc_url( home_url( '/' ).'#focus' ) );	
				 ?>

				<!-- ************************** Footer Title and Features Image First  *****************-->
				<?php   if( !empty( $footer_four_page ) ): 

				$args = array (                                 
					'page_id'           => absint( $footer_four_page ),
					'post_status'       => 'publish',
					'post_type'         => 'page',
				);

				$loop = new WP_Query($args);

				if ( $loop->have_posts() ) : ?>	

				<div class="custom-col-3">
					<?php while ($loop->have_posts()) : $loop->the_post();?>

						<div class="enroll-item">
							<?php if( ( $footer_four_url ) ) { ?>

								<a href="<?php echo esc_url($footer_four_url); ?>">
									<span class="enroll-icon">
										<?php the_post_thumbnail(); ?>
									</span>
									<h4 class="enrol-title"><?php the_title(); ?></h4>
								</a>
							<?php } else{ ?>
								<a href="<?php the_permalink(); ?>">
									<span class="enroll-icon">
										<?php the_post_thumbnail(); ?>
									</span>
									<h4 class="enrol-title"><?php the_title(); ?></h4>
								</a>
							<?php } ?>
						</div>

					<?php endwhile; 
						wp_reset_postdata();?>
				</div>

				<?php endif;

				endif;
				?> 
			</div>

		</div>
</div><!--.enroll-section-->
<?php } ?>
<div class="back-to-top">
	<a href="#masthead" title="Go to Top" class="fa-angle-up"></a>
</div>

<?php	
}
add_action('education_minimal_footer_last_callback_action','education_minimal_footer_last_hook_callback');
