<?php
/**
 * Education Minimal functions and definitions
 *
 * @package Education_Minimal
 */

//=========================================== Category Functions ==================================//

/** Cateogory List **/

function education_minimal_category_lists(){
  $category   = get_categories();
  $cat_list   = array();
  $cat_list[0]= esc_html__('Select category','education-minimal');
  foreach ($category as $cat) {
    $cat_list[$cat->slug]  = $cat->name;
  }
  return $cat_list;
}
//================================== Main Slider===================================================//

/** Slider Function **/

function education_minimal_slider_callback(){

if(get_theme_mod( 'education_minimal_slider_option','no' ) == 'yes'):
	$education_minimal_slider = get_theme_mod('education_minimal_slider_section_cat');
 	$number = get_theme_mod('education_minimal_slider_num',10);
	$search_text = get_theme_mod( 'slider_search_text',esc_html__('Education is the key to unlock the golden door to freedom','education-minimal') ); 
?>
	<section class="featured-slider ">
		<?php
			if( !empty( $education_minimal_slider) ) {
				$loop = new WP_Query(
				array(
				'post_type' => 'post',    
				'category_name' => esc_html($education_minimal_slider),
				'posts_per_page' => absint( $number ),  
				)
				);
			}else{
			$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
		}   
		?>
		<div class="featured-banner">
			<?php
			if($loop->have_posts() ) {

				while($loop->have_posts() ) {

				$loop->the_post();
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-banner-image', true );
				?>
					<div class="slider-content">
						<figure class="slider-image">
							<img src="<?php echo esc_url($image[0]);?>" />
						</figure>
					</div>
			<?php 
			}
			wp_reset_postdata();
			}
			?> 
		</div><!--owl-carousel-->
		<div class="search-course-wrap">

			<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>" class="form-search-course animated wow fadeInDown" data-wow-delay="0.5s" data-wow-offset=""> 
				<?php wp_dropdown_categories( 'show_option_all= Categories' ); ?>
				<input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search all Category', 'education-minimal' ); ?>" />
				<input type="submit" placeholder="search">
			</form>
			<?php if(!empty($search_text)){ ?>
				<h2 class="animated wow fadeInUp" data-wow-delay="0.5s"><?php echo esc_html( $search_text );?> </h2>
			<?php } ?>

		</div><!--.search-course-wrap-->
		
	</section>
<!-- featured-slider ends here -->
<?php endif;   ?>

<?php	

}
add_action('education_minimal_slider_callback_action','education_minimal_slider_callback');

//========================================== Check Plugins Activations  ========================//

add_action( 'tgmpa_register', 'education_minimal_register_required_plugins' );

function education_minimal_register_required_plugins() {
  /*
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.   newsletter
   */
  $plugins = array(

    array(
      'name'        =>esc_html__('Contact Form 7','education-minimal'),
      'slug'        => 'contact-form-7',
      'is_callable' => false,
    ),

    array(
      'name'        => esc_html__('One Click Demo Import','education-minimal'),
      'slug'        => 'one-click-demo-import',
      'is_callable' => false,
    ),

  array(
	    'name'        => esc_html__('newsletter','education-minimal'),
	    'slug'        => 'newsletter',
	    'is_callable' => false,
    ),

    array(
	    'name'        => esc_html__('MailChimp for WordPress','education-minimal'),
	    'slug'        => 'mailchimp-for-wp',
	    'is_callable' => false,
    ),
);
$config = array(
    'id'           => 'education-minimal',      // Unique ID for hashing notices.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false.
    'is_automatic' => false,                   // Automatically activate plugins.
    'message'      => '',                      // Message to output right before the plugins table.
  );

  tgmpa( $plugins, $config );
}


/*Import demo data*/
if ( ! function_exists( 'education_minimal_one_click_notice' ) ) :
    function education_minimal_one_click_notice( $default_text ) { 
        /* translators: Footer Id */
        $info_notice = sprintf( esc_html__( ' Please click %1$s to download the zip files.', 'education-minimal' ), '<a href="'.esc_url( 'https://preview.rigorousthemes.com/education-minimal/demo-content.zip' ).'" rel="designer">'.esc_html__('Here', 'education-minimal').'</a>' );
        $default_text .= '<div class="info-text-wrapper">';
        $default_text .= '<h3>'.esc_html__( 'To import the demo data follow the following steps:','education-minimal' ).'</h3>';
        $default_text .= '<ol>';
         $default_text .= '<li>'.wp_kses_post( $info_notice).'</li>';
        $default_text .= '<li>'.esc_html__( 'Extract the zip file.','education-minimal').'</li>';
        $default_text .= '<li>'.esc_html__( 'Upload the .xml, .wie and .date files on the following options.','education-minimal').'</li>';
        $default_text .= '<li>'.esc_html__( 'Click on Import Demo  Data button.','education-minimal').'</li>';
        $default_text .= '</ol>';
        $default_text .= '</div>';
        
        return $default_text;
    }
    add_filter( 'pt-ocdi/plugin_intro_text', 'education_minimal_one_click_notice' );
endif;

/**
 * Action that happen after import
 */
if ( ! function_exists( 'education_minimal_after_demo_import' ) ) :
    function education_minimal_after_demo_import( $selected_import ) {            //Set Menu
            //Set Menu
            $primary_menu = get_term_by('name', 'Primary', 'nav_menu'); 
            $social_menu = get_term_by('name', 'Social Media', 'nav_menu');  
            $download_menu = get_term_by('name', 'Download Menu', 'nav_menu');  
            
            set_theme_mod( 'nav_menu_locations' , array( 

                'menu-1' => $primary_menu->term_id,

                'social-media' => $social_menu->term_id, 
                'download-menu' => $download_menu->term_id, 
                ) 

            );
            //Set Front page
            $page = get_page_by_title( 'Home');
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }       
    }
    add_action( 'pt-ocdi/after_import', 'education_minimal_after_demo_import' );
endif;