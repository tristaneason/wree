<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Education_Minimal
 */
 $archive_section_button_text = esc_html(get_theme_mod('education_minimal_archive_submit',esc_html__('Read More','education-minimal')));
$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-archive-image', true );
	$off_image = '';	
	if ( !has_post_thumbnail() ): 
		$off_image = 'no-image';
	endif; ?>	
<div class="course-item <?php echo esc_attr( $off_image  ) ?>">
	<div class="course-detail-wrap">

		<?php if (has_post_thumbnail()): 
			?>
			 <figure class="course-thumbnail">

				<a href="<?php the_permalink();?>">
					 <img src="<?php echo esc_url($image[0]);?>" />
				</a>
				
					<?php if (get_theme_mod('education_minimal_archive_section_redmore_optons','no')=='yes') { ?>
						<?php if($archive_section_button_text){ ?>
							<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html($archive_section_button_text); ?></a>
						<?php } ?>  
					<?php } ?>
				 
			</figure>

		<?php endif; ?>

		<div class="course-item-contain">
	 	 	<?php 
			if ( is_singular() ) :
				the_title( '<h4 class="entry-title">', '</h4>' );
				else :
				the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			endif;
			?>
			<div class="entry-content">
				<div class="date-post">
					<?php 
					if ( 'post' === get_post_type() ) :
					?>
					<?php if (get_theme_mod('education_minimal_section_date','no')=='yes') {  ?>
						<div class="entry-meta">
							<?php
							education_minimal_posted_on();
							education_minimal_posted_by();
							?>
						</div><!-- .entry-meta -->
					<?php }?> 	
					<?php endif; ?>
				</div>

				<?php if ( is_singular() ) :
					 echo esc_html(wp_trim_words(get_the_content(),20,'...')); 
					?> 
				<?php endif;

				wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-minimal' ),
				'after'  => '</div>',
				) );
				?>
			</div>

		</div>
	</div>
	<div class="instruct-comment">
		<div class="instructor">
			<figure><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></figure>
			<h6>
				<a href="<?php the_permalink(); ?>"><?php the_author(); ?> </a>
			</h6>
		</div>
		<div class="comment">
			<?php 
			comments_popup_link();
			?>
		</div>
	</div>
</div>