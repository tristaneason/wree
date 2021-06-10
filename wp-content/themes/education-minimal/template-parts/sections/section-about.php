<?php

/**
* About Section
*
* @package Education_Minimal
* 
*/

	if (get_theme_mod('education_minimal_about_option','no')=='yes') {  ?>

			<section class="about-section default-padding">

				<div class="container">

					<?php $about_page  = get_theme_mod('education_minimal_about_one_page'); ?>


					<!-- ************************** About Us Title Subtitle and Features Image First  *****************-->

						<?php   if( !empty( $about_page ) ): 

						$args = array (                                 
						'page_id'           => absint( $about_page ),
						'post_status'       => 'publish',
						'post_type'         => 'page',
						);

						$loop = new WP_Query($args);

						if ( $loop->have_posts() ) : ?>	

							<div class="section-intro">

								<?php while ($loop->have_posts()) : $loop->the_post();?>

									<header class="entry-header animated wow fadeInDown" data-wow-delay="0.5s">
										<h4 class="entry-subtitle">
											<?php echo esc_html(wp_trim_words(get_the_content(),10,'...')); ?>
										</h4>
										<h2 class="entry-title">
											<?php the_title(); ?>
										</h2>
										<?php the_post_thumbnail(); ?>

									</header>
								 <?php endwhile; 
						 		   wp_reset_postdata();?>	
							</div><!--.section-intro-->

					<?php endif;

					endif;

					?> 


					<div class="row">

						<!-- ************************** About Us Descriptions And Image *****************-->

						<?php 
							$about_page_second  = get_theme_mod('education_minimal_about_page');
							$about_vedio_link = get_theme_mod( 'education_minimal_about_vedio_option' );
						 ?>

							<div class="custom-col-8">

								<?php   if( !empty( $about_page_second ) ): 

									$args = array (                                 
									'page_id'           => absint( $about_page_second ),
									'post_status'       => 'publish',
									'post_type'         => 'page',
									);

									$loop = new WP_Query($args);

									if ( $loop->have_posts() ) : ?>	

										<div class="about-wrapper">
											<?php while ($loop->have_posts()) : $loop->the_post();?>
												<div class="entry-content animated wow fadeInDown" data-wow-delay="0.5s">
													<?php echo esc_html(wp_trim_words(get_the_content(),150,'...')); ?>
												</div>
												<div class="welcome-media animated wow fadeInUp" data-wow-delay="0.5s">
													<?php the_post_thumbnail(); ?>
													<a class="popup-video" href="<?php echo esc_url($about_vedio_link);?>"> 
														<span class="media-icon"></span>
													</a>
												</div>

											<?php endwhile; 
								 		   wp_reset_postdata();?>	
										</div>

									<?php endif;

									endif;

									?> 
							</div>

							<!-- ************************** About Us Category ***************************-->

							<?php $education_minimal_about_cat = get_theme_mod('education_minimal_about_section_cat'); 
          					$number = get_theme_mod('education_minimal_about_post_num',10); ?>

							<div class="custom-col-4">

								<?php
								if( !empty( $education_minimal_about_cat) ) {

									$loop = new WP_Query(
									array(
										'post_type' => 'post',    
										'category_name' => esc_html($education_minimal_about_cat),
										'posts_per_page' => absint( $number ),  
										)
									);
								}else{
								$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
								}   
								?>
								
								<div class="silent-feature animated wow fadeInRight" data-wow-delay="0.5s" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_about_bg_image','education-minimal')); ?>') ";>
									<ul>
										<?php
										if($loop->have_posts() ) {

										while($loop->have_posts() ) {

										$loop->the_post(); 
										$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-about-image', true );?>
											<li>
												<div class="silent-feature-item">
													<div class="feature-icon"> <img src="<?php echo esc_url($image[0]);?>" /></div>
													<h4 class="entry-title"> <?php the_title();?> </h4>
													<div class="entry-content">
														<?php echo esc_html(wp_trim_words(get_the_content(),22,'&hellip;')); ?>
													</div>
												</div>
											</li>
										<?php 
										}
										wp_reset_postdata();
										}
										?> 	
									</ul>
								</div><!--silent-feature-->
							</div>
					</div>
				</div>

			</section><!--.about-section-->
	<?php } 