<?php
/**
 * Sanitization functions.
 *
 * @package Education_Minimal
 */

//=========================================== Enable/disable Options ==================================// 

function education_minimal_sanitize_option($input){
        $option = array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
            );     
        if(array_key_exists($input, $option)){
            return $input;
        }
        else
            return '';
    }

//=========================================== Number Options ==================================// 
//
function education_minimal_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}
//=========================================== Category  Sanitizations Functions ==================================//

function education_minimal_sanitize_category_select($input){

    $education_minimal_cat_list = education_minimal_category_lists();
    if(array_key_exists($input,$education_minimal_cat_list)){
        return $input;
    }
    else{
        return '';
    }
}

if ( ! function_exists( 'education_minimal_sanitize_select' ) ) :

    /**
     * Sanitize select.
     *
     * @since 1.0.0
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function education_minimal_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_key( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }

endif;

//==================================== Integer Sanitizations Functions ==================================//



function education_minimal_integer_sanitize($input){
        return intval( $input );
   }
if ( ! function_exists( 'education_minimal_integer_sanitize' ) ) :

/**
 *  Sanitize Multiple Dropdown Taxonomies.
 *  @since 1.0.0
 */
function education_minimal_integer_sanitize( $input ) {
    // Make sure we have array.
    $input = (array) $input;

    // Sanitize each array element.
    $input = array_map( 'absint', $input );

    // Remove null elements.
    $input = array_values( array_filter( $input ) );

    return $input;
}
endif;

//page senitizer
if ( ! function_exists( 'education_minimal_sanitize_dropdown_pages' ) ) :

    /**
     * Sanitize dropdown pages.
     *
     * @since 1.0.0
     *
     * @param int                  $page_id Page ID.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return int|string Page ID if the page is published; otherwise, the setting default.
     */
    function education_minimal_sanitize_dropdown_pages( $page_id, $setting ) {

        // Ensure $input is an absolute integer.
        $page_id = absint( $page_id );

        // If $page_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );

    }

endif;

//=========================================== Sidebar   Sanitizations Functions ==================================//

function education_minimal_radio_sanitize_archive_sidebar($input) {
  $valid_keys = array(
        'sidebar-left' =>  esc_html__('Sidebar Left','education-minimal'),
        'sidebar-right' =>  esc_html__('Sidebar Right','education-minimal'),
        'sidebar-both' =>  esc_html__('Sidebar Both','education-minimal'),
        'sidebar-no' =>  esc_html__('Sidebar No','education-minimal'),
  );
  if ( array_key_exists( $input, $valid_keys ) ) {
     return $input;
  } else {
     return '';
  }
}


