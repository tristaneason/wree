<?php

/**
* Events Section
*
* @package Education_Minimal
* 
*/

if (get_theme_mod('education_minimal_events_option','no')=='yes') {  ?>

	<section class="event-section default-padding">

		<div class="container">

			<?php $events_page  = get_theme_mod('education_minimal_events_page'); ?>

			<!-- ************************** Events Title Subtitle and Features Image First  *****************-->

			<?php   if( !empty( $events_page ) ): 

			$args = array (                                 
				'page_id'           => absint( $events_page ),
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

			<div class="event-wrap">

				<!-- ************************** Events Section Member And Posts *****************-->
				<?php
				$number = get_theme_mod('education_minimal_events_post_num',10);
				$event_cat = get_theme_mod('education_minimal_eventssection_cat'); 
				$readmore = get_theme_mod( 'education_minimal_pro_readmore',esc_html__('Read More','education-minimal') );
				if( !empty( $event_cat) ) {
					$loop = new WP_Query(
					array(
						'post_type' => 'post',    
						'category_name' => esc_html($event_cat),
						'posts_per_page' => absint( $number ),  
						)
					);
				}else{
				$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
				} 
				if($loop->have_posts()): $count= 0; 

					while($loop->have_posts()): $loop->the_post();
						$originalDate = get_the_date();
					     ?> 

						<div class="post animated wow fadeInLeft" data-wow-delay="0.5s">
							<?php $image_size = 'education-minimal-isotope-thumb';
							if ( $count % 2 == 0 ){
								$image_size = 'education-minimal-isotope';
							}
							?>
							<?php if ( has_post_thumbnail() ): ?>
								<feature class="post-image">
									<?php the_post_thumbnail( esc_attr( $image_size ) );?>
								</feature>
							<?php endif; ?>
							<div class="post-content">

								<div class="entry-top">
									<header class="entry-header">
										<h4 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h4>
									</header>
									<?php  if (get_theme_mod('education_minimal_events_calender_option','no')=='yes') { ?>
									<div class="entry-meta">
										<span class="posted-on">
											<i class="fa fa-calendar"></i>
											<a href="<?php the_permalink(); ?>"><?php echo esc_html($originalDate); ?></a>
										</span>
										<span class="posted-on-time">
											<i class="fa fa-clock-o" aria-hidden="true"></i>
											<a href="#" rel="bookmark">
											<time class="entry-time"><?php echo esc_html(date("l")); ?></time>
											</a>
										</span>
									</div>
									<?php } ?>
								</div>

								<div class="entry-content">

									  <p><?php echo esc_html(wp_trim_words(get_the_content(),10,'...')); ?> </p>

										<?php if(!empty($readmore)){ ?>
											<a href="<?php the_permalink();?>" class="button"><?php echo esc_html( $readmore );?>
											</a>
										<?php } ?>	

								</div>

							</div>
							<?php $count++; ?>
						</div>
					<?php endwhile;
					 wp_reset_postdata(); ?> ?>
				<?php endif; ?>	

			</div>

		</div>
	</section><!--.event-section-->
<?php }  ?>