<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Education_Minimal
 */
if ( ! function_exists( 'education_minimal_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function education_minimal_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'education-minimal' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;
if ( ! function_exists( 'education_minimal_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function education_minimal_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'education-minimal' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;
if ( ! function_exists( 'education_minimal_pro_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function education_minimal_pro_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'education-minimal' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'education-minimal' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'education-minimal' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'education-minimal' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'education-minimal' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'education-minimal' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/*-------------------------------------------------------------------------------------*/

if ( ! function_exists( 'education_minimal_comments' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function education_minimal_comments() {

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<div class="comment"><span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'education-minimal' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span></div>';
		}
	}
	
endif;
/*---------------------------------------------------------------------------------------*/

if ( ! function_exists( 'education_minimal_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function education_minimal_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

/*----------------------------------------------------------------------------------------*/

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

function load_search_results() {  
    
    if( isset( $_POST['orderby'] ) ){
        $query = sanitize_key( wp_unslash($_POST['orderby']) );  // WPCS: input var ok; CSRF ok.
    }

    if( isset( $_POST['sorting-query'] ) ){
        $ajax_args = sanitize_key(wp_unslash($_POST['sorting-query']));
    }

    $default = array(        
        'orderby'       => $query
    );

    $args = wp_parse_args(  $default, $ajax_args );    

    $search = new WP_Query( $args );

    ob_start();
    
    if ( $search->have_posts() ) : 
    
    ?>
        <?php
            while ( $search->have_posts() ) : $search->the_post();
                get_template_part( 'template-parts/content', get_post_format() );
            endwhile;  
           
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;
    
    $content = ob_get_clean();
    
    echo wp_kses_post($content);
    die();         
}

if ( ! function_exists( 'education_minimal_navigation' ) ) :

    /**
     * Posts navigation.
     *
     * @since 1.0.0
     */
    function education_minimal_navigation() {

        $pagination_option = get_theme_mod('pagination_theme_options'); 
        if ( 'default' == $pagination_option) {

            the_posts_navigation(); 

        } else{

            the_posts_pagination( array(
                'mid_size' => 5,
                'prev_text' => esc_html__( ' ', 'education-minimal' ),
                'next_text' => esc_html__( ' ', 'education-minimal' ),
            ) );
        }

    }
endif;

add_action( 'education_minimal_action_navigation', 'education_minimal_navigation' );