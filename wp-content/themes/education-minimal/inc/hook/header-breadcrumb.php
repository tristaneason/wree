<?php
/**
 * Education Minimal functions and definitions
 *
 * @package Education_Minimal
 */

//=========================== Page Breadcrumbs ===================//

function education_minimal_sanitize_bradcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}

// Education Minimal breadcrumbs settingg


if ( ! function_exists( 'education_minimal_breadcrumbs' ) ) :

    function education_minimal_breadcrumbs() {
       global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    //$delimiter = '&gt;';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<li id="" class="trail-item trail-begin"><a href="' . esc_url($homeLink) . '">' . esc_html__('Home', 'education-minimal') . '</a></li>';
    } else {

        echo '<li  class="trail-item trail-begin" rel="home"> <a href="' . esc_url($homeLink) . '">' . esc_html__('Home', 'education-minimal') . '</a> </li>';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo esc_html(get_category_parents($thisCat->parent, TRUE, '  ') );
            echo '<li class="trail-items">' . esc_html__('Archive by category','education-minimal').' "' . single_cat_title('', false) . '"' . '</li>';
        } elseif (is_search()) {
            echo '<li class="trail-items">' . esc_html__('Search results for','education-minimal'). '"' . get_search_query() . '"' . '</li>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<li><a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a></li>';
                if ($showCurrent == 1)
                    echo '  ' . '<li class="trail-items">' . esc_html(get_the_title()) . '</li>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = wp_kses_post(get_category_parents($cat, TRUE, ' ') );
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo '<li class ="trail-items">';
                echo wp_kses_post(education_minimal_sanitize_bradcrumb($cats) );
                echo "</li>";
                if ($showCurrent == 1)
                    echo '<li class="trail-items">' . esc_attr(get_the_title()) . '</li>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type() );
            if($post_type){
            echo '<li class="trail-items">' . esc_attr($post_type->labels->singular_name) . '</li>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<li class="trail-items">' . esc_html(get_the_title()) . '</li>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<li class="trail-items">' . esc_attr(get_the_title()) . '</li>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo wp_kses_post(education_minimal_sanitize_bradcrumb($breadcrumbs[$i]));
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_attr($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_attr($delimiter) . ' ' . '<li class="trail-items">' . esc_attr(get_the_title()) . '</li>';
        } elseif (is_tag()) {
            echo '<li class="trail-items">' . esc_html__('Posts tagged','education-minimal').' "' . esc_attr(single_tag_title('', false)) . '"' . '</li>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<li class="trail-items">' . esc_html__('Articles posted by ','education-minimal'). esc_attr($userdata->display_name) . '</li>';
        } elseif (is_404()) {
            echo '<li class="trail-items">' . esc_html__('Error 404','education-minimal') . '</li>';
        }


        echo '</div>';
    }
    }
endif;


 if ( ! function_exists( 'education_minimal_page_title' ) ) :

function education_minimal_page_title(){
    ?>
        <?php if (get_theme_mod('education_minimal_bread_option','no')=='yes') {  ?>    
            <div class="page-title-wrap"  style="background-image: url(<?php header_image(); ?>);">

                   <div class="container">

                        <div class="row">

                            <div class="custom-col-4">

                            <div class="section-intro">

                             <header class="entry-header  wow fadeInDown animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">

                            <?php
                            if(is_archive()) {
                            the_archive_title( '<h4 class="page-title">', '</h4>' );
                            the_archive_description( '<div>', '</div>' );

                            } elseif(is_single() || is_singular('page')) {
                            wp_reset_postdata();
                            the_title('<h4 class="page-title">', '</h4>');
                            } elseif(is_search()) {
                            ?>
                            <h4 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'education-minimal' ), '<span>' . get_search_query() . '</span>' ); ?></h4>
                            <?php
                            } elseif(is_404()) {
                            ?>
                            <h4 class="page-title"><?php esc_html_e( '404 Error', 'education-minimal' ); ?></h4>
                            <?php
                            }
                            ?>

                            </header> 

                            </div>
                            </div>
                            <div class="custom-col-8">
                                <div class="search-course-wrap">
                                    <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>" class="form-search-course animated wow fadeInDown" data-wow-delay="0.5s" data-wow-offset=""> 
                                        <?php wp_dropdown_categories( 'show_option_all= Category Course' ); ?>
                                        <input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search all courses', 'education-minimal' ); ?>" />
                                        <input type="submit" placeholder="search">
                                    </form>
                                    <?php if(!empty($search_text)){ ?>
                                        <h2 class="animated wow fadeInUp" data-wow-delay="0.5s"><?php echo esc_html( $search_text );?> </h2>
                                    <?php } ?>

                                </div><!--.search-course-wrap-->
                            </div>
                        </div>
                    </div>
    				<div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
    					<div class="container">

    						<ul class="trail-items">
    							<?php education_minimal_breadcrumbs(); ?>
    						</ul>

    					</div>
    				</div>
            </div>
         <?php } ?>
    <?php
    }

endif;

add_action('education_minimal_title','education_minimal_page_title');