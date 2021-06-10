<?php

/**
* Promotional Section
*
* @package Education_Minimal
* 
*/

if (get_theme_mod('education_minimal_cta_option','no')=='yes') { 
	$callto_page  = get_theme_mod('education_minimal_process_page_video'); 
	$callto_vedio_link = get_theme_mod( 'education_minimal_frontpage_vedio_option' );
	$callto_readmore = get_theme_mod( 'callto_read_more',esc_html__('Play Now','education-minimal') );

	?>

	<!-- ************************** Call To  Title Subtitle and Features Image   *****************-->

	<?php   if( !empty( $callto_page ) ): 

	$args = array (                                 
	'page_id'           => absint( $callto_page ),
	'post_status'       => 'publish',
	'post_type'         => 'page',
	);

		$loop = new WP_Query($args);

		if ( $loop->have_posts() ) : ?>	

			<section class="cta-section">

					<?php while ($loop->have_posts()) : $loop->the_post();?>

						<div class="cta-top" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_bg_image','')); ?>') ";>

							<div class="cta-top-contain post animated wow fadeInDown" data-wow-delay="0.5s">
								<h2><?php the_title(); ?><span><?php echo esc_html(wp_trim_words(get_the_content(),60,'...')); ?></span></h2>

								<?php if(!empty($callto_readmore)){ ?>
		                            <a href="<?php the_permalink();?>" class="button"><?php echo esc_html( $callto_readmore );?><span></span></a>
		                        <?php } ?>

							</div>

						</div>
						<div class="cta-image post animated wow fadeInUp" data-wow-delay="0.5s">

							<div class="container">
								<?php the_post_thumbnail(); ?>
									<a class="popup-video" href="<?php echo esc_url($callto_vedio_link);?>"> 
									 	 <span class="media-icon"></span>
									</a>
							</div>

						</div>

					<?php endwhile; 
					 wp_reset_postdata(); ?>	

			</section><!--.cta-section-->

	<?php endif;
	endif;
	?> 
<?php }  ?>