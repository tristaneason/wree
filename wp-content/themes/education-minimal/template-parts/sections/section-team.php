<?php
/**
* Team  Section
*
* @package Education_Minimal
*/
	if (get_theme_mod('education_minimal_team_option','no')=='yes') {  ?>

			<section class="team-section default-padding">

				<div class="container">

					<?php $team_page  = get_theme_mod('education_minimal_team_page');?>

					<!-- ************************** Team Section Title Subtitle and Features Image First  *****************-->

					<?php   if( !empty( $team_page ) ): 

						$args = array (                                 
						'page_id'           => absint( $team_page ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

							<?php while ($loop->have_posts()) : $loop->the_post();?>

								<div class="section-intro animated wow fadeInDown" data-wow-delay="0.5s">

									<header class="entry-header">

										<h4 class="entry-subtitle">
											<?php the_title(); ?>
										</h4>
										<h2 class="entry-title">
											<?php echo esc_html(wp_trim_words(get_the_content(),10,'...')); ?>
										</h2>

										<?php the_post_thumbnail(); ?>
									</header>

								</div><!--section-intro-->

								<?php endwhile; 
					 		 	  wp_reset_postdata();?>
								<?php endif;

								endif;

								?>

								<!-- ************************** Team Section Member And Posts *****************-->

								<?php
								$number = get_theme_mod('education_minimal_team_post_num',10);
								$team_cat = get_theme_mod('education_minimal_team_section_cat'); 
								$team_readmore = get_theme_mod( 'education_minimal_team_readmore',esc_html__('View Detail','education-minimal') );
								if( !empty( $team_cat) ) {
									$loop = new WP_Query(
									array(
										'post_type' => 'post',    
										'category_name' => esc_html($team_cat),
										'posts_per_page' => absint( $number ),  
										)
									);
								}else{
								$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
								} 
								if($loop->have_posts()): ?> 	

									<div class="our-team">

									  	<?php while($loop->have_posts()): $loop->the_post();
								  	 		$image = wp_get_attachment_image_src( get_post_thumbnail_id(),'education-minimal-team-image', true );?>
											<div class="team-item animated wow fadeInLeft" data-wow-delay="0.5s">
												<figure>
													<img src="<?php echo esc_url($image[0]);?>" />
												</figure>
												<div class="team-content">
													<div class="team-content-info">
														<h4><?php the_title(); ?></h4>
														<span><?php echo esc_html(wp_trim_words(get_the_content(),10,'...')); ?></span> 
													</div>
												</div>
												<!-- ******************* Team Section Read More ***************-->
												<?php if(!empty($team_readmore)){ ?>
													<a href="<?php the_permalink();?>" class="button"><?php echo esc_html( $team_readmore );?>
													</a>
												<?php } ?>		
											</div>	
										<?php endwhile; ?>

									</div>
					</div>
				<?php endif; ?>
			</section><!--.team-section-->	
<?php }  ?>