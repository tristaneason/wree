<?php

/**
* Feature Section
*
* @package Education_Minimal
* 
*/
	if (get_theme_mod('education_minimal_feature_option','no')=='yes') {  ?>

		<section class="course default-padding">

			<div class="container">

				<?php $feature_page  = get_theme_mod('education_minimal_feature_page');?>

					<!-- ************************** Feature Title Subtitle and Features Image First  *****************-->

					<?php   if( !empty( $feature_page ) ): 

						$args = array (                                 
						'page_id'           => absint( $feature_page ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

							<div class="section-intro animated wow fadeInDown" data-wow-delay="0.5s">

								<?php while ($loop->have_posts()) : $loop->the_post();?>

									<header class="entry-header">
										<h4 class="entry-subtitle">

											<?php the_title(); ?>

										</h4>
										<h2 class="entry-title">
											<?php echo esc_html(wp_trim_words(get_the_content(),60,'...')); ?>
										</h2>
											<?php the_post_thumbnail(); ?>
									</header>

								<?php endwhile; 
					 		   wp_reset_postdata();?>

							</div>

					<?php endif;

					endif;

					?> 

				<!-- ************************** Feature Section Category *****************-->

				<?php
					$education_minimal_feature_section_cat = get_theme_mod('education_minimal_feature_section_cat'); 
					$number = get_theme_mod('education_minimal_feature_post_num',10); 
					$feature_cat_id = get_category_by_slug( $education_minimal_feature_section_cat );
					$url = get_category_link( $feature_cat_id );
					$readmore = get_theme_mod( 'education_minimal_feature_readmore',esc_html__('View Detail','education-minimal') );
					$all_courses = get_theme_mod( 'education_minimal_feature_readmore_courses',esc_html__('View All Courses','education-minimal') );
				 ?>	

					<div class="row">
						<?php
						if( !empty( $education_minimal_feature_section_cat) ) {
							$loop = new WP_Query(
							array(
								'post_type' => 'post',    
								'category_name' => esc_html($education_minimal_feature_section_cat),
								'posts_per_page' => absint( $number ),  
								)
							);
						}else{
						$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
						} ?>
						<?php
						if($loop->have_posts() ) {

							while($loop->have_posts() ) {
								$loop->the_post(); 
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-banner-image', true );?>

									<div class="custom-col-4">

										<div class="course-item animated wow fadeInDown" data-wow-delay="0.5s">

											<figure class="course-thumbnail">
												<img src="<?php echo esc_url($image[0]);?>" />
											</figure>
											<div class="course-item-contain">
												<h4 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h4>
												<div class="entry-content">
													<?php echo esc_html(wp_trim_words(get_the_content(),22,'&hellip;')); ?>
												</div>
											</div>
											<?php  if (get_theme_mod('education_minimal_feature_super_option','no')=='yes') { ?>
												<div class="instruct-comment">
													<div class="instructor">
														<figure><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></figure>
														<?php education_minimal_posted_by(); ?>
													</div>
													<div class="comment">
														<?php 
															education_minimal_comments();
														?>	
													</div>
												</div>
											<?php } ?>
											<?php if(!empty($readmore)){ ?>
												<a href="<?php the_permalink();?>" class="button"><?php echo esc_html( $readmore );?></a>
											<?php } ?>

										</div>

									</div>
							
							<?php }
							wp_reset_postdata();
						} ?>

					</div>

					<a href="<?php echo esc_url( $url );?>" class="view-more"><?php echo esc_html( $all_courses );?></a>

				</div>
		</section><!--.course section-->
<?php }  ?>