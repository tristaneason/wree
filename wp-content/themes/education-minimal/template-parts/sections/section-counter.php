<?php
/**
* Counter Section
*
* @package Education_Minimal
* 
*/
	if (get_theme_mod('education_minimal_counter_option','no')=='yes') {  ?>

	<section class="company-info" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_counter_bg_image','')); ?>') ";>
		<div class="container">
			<div class="company-info-wrap">
				<div class="row">

					<?php $counter_page  = get_theme_mod('education_minimal_counter_page_one');
					 $first_counter_number = get_theme_mod('first_counter_number'); ?>

					<!-- ************************** Counter Title Subtitle and Features Image First  *****************-->

					<?php   if( !empty( $counter_page ) ): 

						$args = array (                                 
						'page_id'           => absint( $counter_page ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

						<div class="custom-col-6">

							<?php while ($loop->have_posts()) : $loop->the_post();?>

								<div class="company-info-item animated wow fadeInDown" data-wow-delay="0.5s">
									<span class="company-info-icon">
										<?php the_post_thumbnail(); ?>
									</span>
									<?php if($first_counter_number){ ?>
									<span class="company-info-count">
										 <?php echo absint($first_counter_number); ?>
									</span>
									<?php } ?>
									<h4><?php the_title(); ?></h4>
								</div>

							<?php endwhile; 
					 		   wp_reset_postdata();?>	
						</div>

					<?php endif;

					endif;

					?> 

					<?php $counter_page_two  = get_theme_mod('education_minimal_counter_page_two');
					 $second_counter_number = get_theme_mod('second_counter_two');
					 ?>

					<!-- ************************** Counter Title Subtitle and Features Image First  *****************-->

					<?php   if( !empty( $counter_page_two ) ): 

						$args = array (                                 
						'page_id'           => absint( $counter_page_two ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

							<div class="custom-col-6">

								<?php while ($loop->have_posts()) : $loop->the_post();?>

									<div class="company-info-item animated wow fadeInDown" data-wow-delay="0.5s">
										<span class="company-info-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<?php if($second_counter_number){ ?>					
											<span class="company-info-count">
												<?php echo absint($second_counter_number); ?>
											</span>
										<?php } ?>
										<h4><?php the_title(); ?></h4>
									</div>

									<?php endwhile; 
					 		   wp_reset_postdata();?>

							</div>

						<?php endif;

					endif;

					?> 	
					<?php $counter_page_three  = get_theme_mod('education_minimal_counter_page_three');
					 $third_counter_number = get_theme_mod('third_counter_three');
					 ?>

					 <!-- ************************** Counter Title Subtitle and Features Image First  *****************-->

					<?php   if( !empty( $counter_page_three ) ): 

						$args = array (                                 
						'page_id'           => absint( $counter_page_three ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

							<div class="custom-col-6">

									<?php while ($loop->have_posts()) : $loop->the_post();?>

									<div class="company-info-item animated wow fadeInDown" data-wow-delay="0.5s">
										<span class="company-info-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<span class="company-info-count">
											<?php if($third_counter_number){ ?><?php echo absint($third_counter_number); ?><?php } ?>
										</span>
											<h4><?php the_title(); ?></h4>
									</div>

								<?php endwhile; 
					 		   wp_reset_postdata();?>
					 		   	
							</div>
						<?php endif;

						endif;
						?> 

					<?php $counter_page_four  = get_theme_mod('education_minimal_counter_page_four');
					 $fourth_counter_number = get_theme_mod('four_counter_four');
					 ?>	

					 <!-- ************************** Counter Title Subtitle and Features Image First  *****************-->

					<?php   if( !empty( $counter_page_four ) ): 

						$args = array (                                 
						'page_id'           => absint( $counter_page_four ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

							<div class="custom-col-6">

								<?php while ($loop->have_posts()) : $loop->the_post();?>

									<div class="company-info-item animated wow fadeInDown" data-wow-delay="0.5s">
										<span class="company-info-icon">
											<?php the_post_thumbnail(); ?>
										</span>
										<span class="company-info-count">
											<?php if($fourth_counter_number){ ?><?php echo absint($fourth_counter_number); ?><?php } ?>
										</span>
										<h4><?php the_title(); ?></h4>
									</div>

								<?php endwhile; 
					 		   wp_reset_postdata();?>
							</div>

						<?php endif; endif; ?> 
				</div>
			</div>
			<?php 
			$counter_img = get_theme_mod('education_minimal_counter_image','education-minimal-image');
			?>
			<figure class="animated wow fadeInRight" data-wow-delay="0.5s">
			<?php  if(!empty($counter_img)){ ?>  	
				<a href="<?php the_permalink();?>"><img src="<?php echo esc_url($counter_img); ?>" /></a>
		    <?php } ?> 
			</figure>
		</div>
	</section><!--.company-info section-->
<?php }  ?>