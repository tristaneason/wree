<?php
/**
* Testimonial Section
*
* @package Education_Minimal
* 
*/
	if (get_theme_mod('education_minimal_testimonial_option','no')=='yes') { 

		$testimonial_category =  get_theme_mod('education_minimal_testimonial_section_cat' );

     	$number = get_theme_mod('education_minimal_testimonial_post_num',10);

	 ?>	
					<?php
		if( !empty( $testimonial_category) ) {

		$loop = new WP_Query(
			array(
				'post_type' => 'post',    
				'category_name' => esc_html($testimonial_category),
				'posts_per_page' => absint( $number ),  
			)
		);
		}else{
			$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
		}   
		?>
		<section class="testimonial default-padding" style="background-image: url('<?php echo esc_url(get_theme_mod('education_minimal_testimonial_bg_image','')); ?>') ";>

			<div class="testimonial-image animated wow fadeInDown" data-wow-delay="0.5s">
				<?php
				if($loop->have_posts() ) {

				while($loop->have_posts() ) {

				$loop->the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-banner-image', true );?>

				<div class="image-item">
					<figure>
						<img src="<?php echo esc_url($image[0]);?>" />
					</figure>
				</div>
				<?php 
				}
				wp_reset_postdata();
				}
				?>
			</div>
			<div class="testimonial-content animated wow fadeInUp" data-wow-delay="0.5s">
				<?php
				if($loop->have_posts() ) {

				while($loop->have_posts() ) {

				$loop->the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-banner-image', true );?>
					<div class="content-item">
						<h3> <?php the_title(); ?> </h3>
						<?php echo esc_html(wp_trim_words(get_the_content(),22,'&hellip;')); ?>
					</div>
				<?php 
				}
				wp_reset_postdata();
				}
				?>	
			</div>
		</section><!--.testimonial section-->
<?php }  ?>