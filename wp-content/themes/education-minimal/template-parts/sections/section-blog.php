<?php

/**
* Blog Section
*
* @package Education_Minimal
* 
*/

if (get_theme_mod('education_minimal_blog_option','no')=='yes') {  ?>

	<section class="blog-section default-padding">

		<div class="container">

			<?php $blog_page  = get_theme_mod('education_minimal_blog_page'); ?>

			<!-- ************************** Blog Title, Subtitle And Image  *****************-->

				<?php   if( !empty( $blog_page ) ): 

					$args = array (                                 
					'page_id'           => absint( $blog_page ),
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
				 		   
					</div><!--section-intro-->

			<?php endif;

				endif;
				?> 

			<!-- ************************** Blog Category Secions Starting   *****************-->

			<?php 
			$education_minimal_about_cat = get_theme_mod('education_minimal_blog_section_cat'); 
			$number = get_theme_mod('education_minimal_blog_post_num',10);
			$blog_readmore = get_theme_mod( 'education_minimal_blog_read_more',esc_html__('Read More','education-minimal') ); ?>

			<div class="blog-wrap">
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
					if($loop->have_posts() ) {

					while($loop->have_posts() ) {

					$loop->the_post(); 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-blog-image', true );
					$originalDate = get_the_date();
					?>
					
				<!-- ************************** Blog Category Secions Starting   *****************-->


					<div class="post animated wow fadeInLeft" data-wow-delay="0.5s">

						<feature class="post-image">
							<img src="<?php echo esc_url($image[0]);?>" />
							<?php if(!empty($blog_readmore)){ ?>
								<a href="<?php the_permalink();?>" class="button"><?php echo esc_html( $blog_readmore );?></a>
							<?php } ?>
						</feature>

						<div class="post-content">
							<header class="entry-header">
								<h4 class="entry-title">
									 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
								</h4>
							</header>
							<div class="entry-meta">
								<span class="posted-on">
									<i class="fa fa-calendar"></i>
									<a href="#" rel="bookmark">
									<?php ?> 
									 <a href="<?php the_permalink(); ?>"><?php echo esc_html($originalDate); ?></a>
									</a>
								</span>
								<div class="post-cat-list">
									<i class="fa fa-tag"></i>
									<span class="cat-links">
									<?php the_category( ' ' ); ?>
									</span>
								</div>
							</div>
							<div class="entry-content">
								 <?php echo esc_html(wp_trim_words(get_the_content(),22,'&hellip;')); ?>
							</div>
						</div>

					</div><!--.post-->

				<!-- ************************************* Ending Blog Category *****************-->
				<?php 
					}
					wp_reset_postdata();
					}
					?>
			</div><!--.blog-wrap-->

		</div>

	</section><!--.blog-section-->
<?php }  ?>