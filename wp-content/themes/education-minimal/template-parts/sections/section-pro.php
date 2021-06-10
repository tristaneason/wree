<?php

/**
* Promotional Section
*
* @package Education_Minimal
* 
*/
	if (get_theme_mod('education_minimal_pro_option','no')=='yes') {  ?>
		<?php 
		$education_minimal_pro_cat = get_theme_mod('education_minimal_pro_section_cat'); 
		$number = get_theme_mod('education_minimal_pro_post_num',10); 
		?>
		<section class="promo-section" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_pro_image','')); ?>') ";>

			<div class="promo-wrap">
				<?php
				if( !empty( $education_minimal_pro_cat) ) {

					$loop = new WP_Query(
						array(
							'post_type' => 'post',    
							'category_name' => esc_html($education_minimal_pro_cat),
							'posts_per_page' => absint( $number ),  
						)
					);
				}else{
					$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
				}   
				?>
				<?php
				if($loop->have_posts() ) {

					while($loop->have_posts() ) {

						$loop->the_post(); 
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-pro-image', true );
						$pro_readmore = get_theme_mod( 'eduction_minimal_pro_readmore',esc_html__('Apply Now','education-minimal') );
						$originalDate = get_the_date();
						?>
						
						<div class="promo-item">
							<div class="container">
								<div class="section-intro animated wow fadeInLeft" data-wow-delay="0.5s">
									<header class="entry-header">
										<?php if($originalDate) { ?>
											<h4 class="entry-subtitle">
												<?php echo esc_html($originalDate); ?> 
											</h4>
										 <?php } ?>
										<h2 class="entry-title">
											<?php the_title(); ?>
										</h2>

										<!-- ************************** Promotional Section Read More **************************************-->
										<?php if(!empty($pro_readmore)){ ?>
											<a href="<?php the_permalink();?>" class="button"><?php echo esc_html( $pro_readmore );?></a>
										<?php } ?>	

									</header>
								</div><!--section-intro-->
								<figure class="animated wow fadeInRight" data-wow-delay="0.5s">
									<img src="<?php echo esc_url($image[0]);?>" />
								</figure>
							</div>
						</div>

						<?php 
					}
					wp_reset_postdata();
				}
				?>
			</div>
		</section><!--.promo-section-->
<?php }  ?>