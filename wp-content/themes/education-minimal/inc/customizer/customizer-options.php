<?php
/**
 * Theme Customizer Custom
 *
 * @package  Education_Minimal
 */

/**
 * Add new options the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function education_minimal_custom_customize_register( $wp_customize ) { 

	require get_template_directory() . '/inc/customizer/sanitizer.php';

  /****************  Add Deafult  Pannel   ***********************/
    
	$wp_customize->add_panel('education_minimal_default_setups',
		array(
			'priority' => '10',
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html__('Default/Basic Setting','education-minimal'),
	));

	// Education Minimal  Category Posts List.
  // 
  $education_minimal_category_lists = education_minimal_category_lists();
	/****************  Add Default Sections to General Panel ************/
	$wp_customize->get_section('title_tagline')->panel = 'education_minimal_default_setups'; //priority 20
	$wp_customize->get_section('colors')->panel = 'education_minimal_default_setups'; //priority 40
	$wp_customize->get_section('background_image')->panel = 'education_minimal_default_setups'; //priority 80
	$wp_customize->get_section('static_front_page')->panel = 'education_minimal_default_setups'; //priority 120

	$wp_customize->get_section( 'header_image' )->panel = 'education_minimal_heading_setups';
	$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Innerpages Header Image', 'education-minimal' );
	$wp_customize->get_section( 'header_image' )->priority = '25';

    /************************  Site Identity  ******************/

    $wp_customize->add_setting('site_identity_options', 
        array(
        'default'           => 'title-text',
        'sanitize_callback' => 'education_minimal_sanitize_select'
        )
    );
    $wp_customize->add_control('site_identity_options', 
        array(    
        'priority' => '20',  
        'label'     => esc_html__('Choose Options', 'education-minimal'),
        'section'   => 'title_tagline',
        'settings'  => 'site_identity_options',
        'type'      => 'radio',
        'choices'   =>  array(
              'logo-only'     => esc_html__('Logo Only', 'education-minimal'),
              'logo-text'     => esc_html__('Logo + Tagline', 'education-minimal'),
              'title-only'    => esc_html__('Title Only', 'education-minimal'),
              'title-text'    => esc_html__('Title + Tagline', 'education-minimal')
            )
        )
    );

 	 /***********************************  Starting Heading Section ***********************/

	$wp_customize->add_panel('education_minimal_heading_setups',
	array(
		'priority' => '1',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__('Header Setting ','education-minimal'),
	));

  /***********************************  Starting Heading  ********************/

  $wp_customize->add_section('education_mnimal_header_setups',
    array(
      'priority' => '1',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Header Section','education-minimal'),
      'panel' => 'education_minimal_heading_setups'
    ));
  //Header Ticker  Enable/Disable

  $wp_customize->add_setting('education_minimal_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_option',
      array(
          'description'   =>  esc_html__('Enable/Disable Ticker','education-minimal'),
          'section'       =>  'education_mnimal_header_setups',
          'setting'       =>  'education_minimal_option',
          'priority'      =>  1,
          'type'          =>  'radio',
          'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

 //Header Ticker Text More Text

  $wp_customize->add_setting('header_tiker_text',
    array(
        'default'           =>  esc_html__('NOTICE','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('header_tiker_text',
    array(
        'priority'      =>  2,
        'label'         =>  esc_html__('Ticker Title','education-minimal'),
        'section'       =>  'education_mnimal_header_setups',
        'setting'       =>  'header_tiker_text',
        'type'          =>  'text',  
      )                                     
  );

	//Select Category For Header Ticker Section

  $wp_customize->add_setting('education_minimal_ticker_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_ticker_section_cat',
        array(
        'priority'      =>  2,
        'label'         =>  esc_html__('Select Category For Header Ticker','education-minimal'),
        'section'       =>  'education_mnimal_header_setups',
        'setting'       =>  'education_minimal_ticker_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );

 //  Post Number Count

  $wp_customize->add_setting('education_minimal_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Header Ticker','education-minimal'),
        'section' => 'education_mnimal_header_setups',
        'setting' => 'education_minimal_post_num',
        'priority'      =>  5,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );

  //Header Ticker  Enable/Disable
  $wp_customize->add_setting('education_minimal_social_menu_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_social_menu_option',
      array(
            'description'   =>  esc_html__('Enable/Disable  Header Social ','education-minimal'),
            'section'       =>  'education_mnimal_header_setups',
            'setting'       =>  'education_minimal_social_menu_option',
            'priority'      =>  7,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

    //Header Menu  Enable/Disable
  $wp_customize->add_setting('education_minimal_download_menu_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_download_menu_option',
      array(
            'description'   =>  esc_html__('Enable/Disable  Download Menu  ','education-minimal'),
            'section'       =>  'education_mnimal_header_setups',
            'setting'       =>  'education_minimal_download_menu_option',
            'priority'      =>  8,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

      // Download Text 
    $wp_customize->add_setting('education_minimal_download_text'
      ,array(
      'default'           =>  esc_html__('Download','education-minimal'),
      'sanitize_callback' =>  'sanitize_text_field',
      )
    );

    $wp_customize->add_control('education_minimal_download_text',
      array(
      'priority'      =>  9,
      'label'         =>  esc_html__('Download Text','education-minimal'),
      'section'       =>  'education_mnimal_header_setups',
      'setting'       =>  'education_minimal_download_text',
      'type'          =>  'text',  
      )                                     
    );

    //Download Text Link

    $wp_customize->add_setting('education_minimal_download_link',
      array(
            'default'           =>  esc_html__('# ','education-minimal'),
            'sanitize_callback' =>  'esc_url_raw',
             )
      );

    $wp_customize->add_control('education_minimal_download_link',
      array(
            'priority'      =>  10,
            'label'         =>  esc_html__('Download Link','education-minimal'),
            'section'       =>  'education_mnimal_header_setups',
            'setting'       =>  'education_minimal_download_link',
            'type'          =>  'text',  
        )                                     
   );

    // Inquery Text 
    $wp_customize->add_setting('education_minimal_download_inquery_text'
      ,array(
      'default'           =>  esc_html__('Inquery Text','education-minimal'),
      'sanitize_callback' =>  'sanitize_text_field',
      )
    );

    $wp_customize->add_control('education_minimal_download_inquery_text',
      array(
      'priority'      =>  11,
      'label'         =>  esc_html__('Inquery Text','education-minimal'),
      'section'       =>  'education_mnimal_header_setups',
      'setting'       =>  'education_minimal_download_inquery_text',
      'type'          =>  'text',  
      )                                     
    );

    //Inquery  Text Link

    $wp_customize->add_setting('education_minimal_inquery_link',
      array(
            'default'           =>  esc_html__('# ','education-minimal'),
            'sanitize_callback' =>  'esc_url_raw',
             )
      );

    $wp_customize->add_control('education_minimal_inquery_link',
      array(
            'priority'      =>  12,
            'label'         =>  esc_html__('Inquery Link','education-minimal'),
            'section'       =>  'education_mnimal_header_setups',
            'setting'       =>  'education_minimal_inquery_link',
            'type'          =>  'text',  
        )                                     
   );

  /*********************************** Header Breadcrumbs Settigs ************************************/

   $wp_customize->add_section('education_mnimal_header_breadcrumb_setups',
      array(
        'priority' => '1',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Header Breadcrumbs Section','education-minimal'),
        'panel' => 'education_minimal_heading_setups'
    ));

  //Header BreadCrumbs Enable/Disable

  $wp_customize->add_setting('education_minimal_bread_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_bread_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Header BreadCrumbs','education-minimal'),
            'section'       =>  'education_mnimal_header_breadcrumb_setups',
            'setting'       =>  'education_minimal_bread_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );
  $wp_customize->add_setting('education_minimal_404_bg_image',
    array(
      'default' =>  get_template_directory_uri().'/assets/img/mistake.jpg',
      'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_404_bg_image',
    array(
      'label'      => esc_html__( ' 404 Page Image ', 'education-minimal' ),
      'section'    => 'education_mnimal_header_breadcrumb_setups',
      'settings'   => 'education_minimal_404_bg_image',
      'priority' => 10,
    )
  )
  );

  /***********************************  Starting Main Slider **********************************************/

   $wp_customize->add_panel('education_minimal_homepage_setups',
    array(
      'priority' => '16',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('FrontPage Setting ','education-minimal'),
      ));

    /***********************************  Starting Main Slider **************************************/

  $wp_customize->add_section('education_minimal_banner_setups',
    array(
      'priority' => '1',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Slider Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Banner  Enable/Disable

  $wp_customize->add_setting('education_minimal_slider_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_slider_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Slider Section','education-minimal'),
            'section'       =>  'education_minimal_banner_setups',
            'setting'       =>  'education_minimal_slider_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

    //Select Category For Slider  Section

  $wp_customize->add_setting('education_minimal_slider_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_slider_section_cat',
        array(
        'priority'      =>  2,
        'label'         =>  esc_html__('Select Category For Header Ticker','education-minimal'),
        'section'       =>  'education_minimal_banner_setups',
        'setting'       =>  'education_minimal_slider_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );

    // Slider Post Number Count

    $wp_customize->add_setting('education_minimal_slider_num', 
        array(
          'default' => '5',
            'sanitize_callback' => 'education_minimal_integer_sanitize',
        )
    );
      
    $wp_customize->add_control('education_minimal_slider_num',
      array(
          'type' => 'number',
          'label' => esc_html__('No. of Slider','education-minimal'),
          'section' => 'education_minimal_banner_setups',
          'setting' => 'education_minimal_slider_num',
          'input_attrs' => array(
          'min' => 1,
          'max' => 9,
        ),
      )
    );

   // Slider Search Text 

  $wp_customize->add_setting('slider_search_text',
    array(
        'default'           =>  esc_html__('Education is the key to unlock the golden door to freedom','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('slider_search_text',
    array(
        'priority'      =>  2,
        'label'         =>  esc_html__('Slider Search Text','education-minimal'),
        'section'       =>  'education_minimal_banner_setups',
        'setting'       =>  'slider_search_text',
        'type'          =>  'text',  
      )                                     
  );

 
  /***********************************  Starting Abut Section **********************************************/

  $wp_customize->add_section('education_minimal_about_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('About Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

    //About Enable/Disable
  $wp_customize->add_setting('education_minimal_about_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_about_option',
      array(
            'description'   =>  esc_html__('Enable/Disable About Section','education-minimal'),
            'section'       =>  'education_minimal_about_setups',
            'setting'       =>  'education_minimal_about_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  $wp_customize->add_setting('education_minimal_about_one_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
    )
  );

  $wp_customize->add_control('education_minimal_about_one_page',
    array(
      'description'   =>  esc_html__('It will Display Section Title,Subtile and Feature Image','education-minimal'),
      'priority'=>    4,
      'label'   =>    esc_html__( 'Select Page For About Section','education-minimal' ),
      'section' =>    'education_minimal_about_setups',
      'setting' =>    'education_minimal_about_one_page',
      'type'    =>    'dropdown-pages',
    )                                     
  );

  $wp_customize->add_setting('education_minimal_about_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
    )
  );

  $wp_customize->add_control('education_minimal_about_page',
    array(
      'priority'=>    4,
      'label'   =>    esc_html__( 'Select Page For About Section','education-minimal' ),
      'section' =>    'education_minimal_about_setups',
      'setting' =>    'education_minimal_about_page',
      'type'    =>    'dropdown-pages',
    )                                     
  );

  //Select Category For About  Section

  $wp_customize->add_setting('education_minimal_about_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_about_section_cat',
        array(
        'priority'      =>  6,
        'label'         =>  esc_html__('Select Category For About Us Section ','education-minimal'),
        'section'       =>  'education_minimal_about_setups',
        'setting'       =>  'education_minimal_about_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );
   // About Post Number Count

  $wp_customize->add_setting('education_minimal_about_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_about_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On About Category','education-minimal'),
        'section' => 'education_minimal_about_setups',
        'setting' => 'education_minimal_about_post_num',
        'priority'      =>  5,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );

  $wp_customize->add_setting('education_minimal_about_bg_image',
  array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw'
  )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_about_bg_image',
  array(
    'label'      => esc_html__( ' About Background Image ', 'education-minimal' ),
    'section'    => 'education_minimal_about_setups',
    'settings'   => 'education_minimal_about_bg_image',
    'priority' => 10,
     )
   )
  );
  $wp_customize->add_setting('education_minimal_about_vedio_option',
      array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
      )
  );

  $wp_customize->add_control('education_minimal_about_vedio_option',
    array(
      'priority'      =>  15,
      'label'         => esc_html__( 'Type Video URL For About Section.', 'education-minimal' ),
      'description'   => esc_html__( 'Use Link from youtube', 'education-minimal' ),
      'section'       => 'education_minimal_about_setups',
      'settings'      => 'education_minimal_about_vedio_option',
      'type'          => 'url'
    )
  );

  /***************************** Starting Counter Section *******************************/

   $wp_customize->add_section('education_minimal_counter_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Counter Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Counter  Enable/Disable
  $wp_customize->add_setting('education_minimal_counter_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_counter_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Counter Section','education-minimal'),
            'section'       =>  'education_minimal_counter_setups',
            'setting'       =>  'education_minimal_counter_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );
  // Counter Page First
  $wp_customize->add_setting('education_minimal_counter_page_one',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_counter_page_one',
    array(
      'priority'=>    2,
      'label'   =>    esc_html__( 'Select Page For Counter One','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Feature Image And Title .','education-minimal'),
      'section' =>    'education_minimal_counter_setups',
      'setting' =>    'education_minimal_counter_page_one',
      'type'    =>    'dropdown-pages',
     )                                     
    );
  // Counter Number First
  $wp_customize->add_setting('first_counter_number', 
    array(
      'default' => '47',
      'sanitize_callback' => 'education_minimal_sanitize_number',
      'transport' => 'refresh'
    )
  );    
  $wp_customize->add_control('first_counter_number',
  array(
    'priority'=>    3,
    'type' => 'number',
    'label' => esc_html__( 'counter Number One', 'education-minimal' ),
    'section' => 'education_minimal_counter_setups',
    'priority' => '4'
     )
  );

   // Counter Page Second 
  $wp_customize->add_setting('education_minimal_counter_page_two',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_counter_page_two',
    array(
      'priority'=>    4,
      'label'   =>    esc_html__( 'Select Page For Counter Two','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Feature Image And Title .','education-minimal'),
      'section' =>    'education_minimal_counter_setups',
      'setting' =>    'education_minimal_counter_page_two',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  // Counter Number Two
  $wp_customize->add_setting('second_counter_two', 
    array(
      'default' => '8',
      'sanitize_callback' => 'education_minimal_sanitize_number',
      'transport' => 'refresh'
    )
  );    
  $wp_customize->add_control('second_counter_two',
  array(
    'priority'=>    5,
    'type' => 'number',
    'label' => esc_html__( 'Counter Number Two', 'education-minimal' ),
    'section' => 'education_minimal_counter_setups',
     )
  );


   // Counter Page Three
  $wp_customize->add_setting('education_minimal_counter_page_three',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_counter_page_three',
    array(
      'priority'=>    5,
      'label'   =>    esc_html__( 'Select Page For Counter Three','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Feature Image And Title .','education-minimal'),
      'section' =>    'education_minimal_counter_setups',
      'setting' =>    'education_minimal_counter_page_three',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  // Counter Number Three
  $wp_customize->add_setting('third_counter_three', 
    array(
      'default' => '15',
      'sanitize_callback' => 'education_minimal_sanitize_number',
      'transport' => 'refresh'
    )
  );    
  $wp_customize->add_control('third_counter_three',
  array(
    'priority'=>    6,
    'type' => 'number',
    'label' => esc_html__( 'Counter Number Three', 'education-minimal' ),
    'section' => 'education_minimal_counter_setups',
     )
  );

  // Counter Page Four
  $wp_customize->add_setting('education_minimal_counter_page_four',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_counter_page_four',
    array(
      'priority'=>    7,
      'label'   =>    esc_html__( 'Select Page For Counter Four','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Feature Image And Title .','education-minimal'),
      'section' =>    'education_minimal_counter_setups',
      'setting' =>    'education_minimal_counter_page_four',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  // Counter Number Four
  $wp_customize->add_setting('four_counter_four', 
    array(
      'default' => '21',
      'sanitize_callback' => 'education_minimal_sanitize_number',
      'transport' => 'refresh'
    )
  );    
  $wp_customize->add_control('four_counter_four',
  array(
    'priority'=>    8,
    'type' => 'number',
    'label' => esc_html__( 'Counter Number Four', 'education-minimal' ),
    'section' => 'education_minimal_counter_setups',
     )
  );

  $wp_customize->add_setting('education_minimal_counter_image',
    array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_counter_image',
    array(
      'label'      => esc_html__( ' Counter  Image ', 'education-minimal' ),
      'section'    => 'education_minimal_counter_setups',
      'settings'   => 'education_minimal_counter_image',
      'priority' => 9,
      )
     )
    );
  $wp_customize->add_setting('education_minimal_counter_bg_image',
    array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_counter_bg_image',
  array(
      'label'      => esc_html__( ' Counter Background Image', 'education-minimal' ),
       'description'   =>  esc_html__('This Will Upload Image For Background On About Section .','education-minimal'),
      'section'    => 'education_minimal_counter_setups',
      'settings'   => 'education_minimal_counter_bg_image',
      'priority' => 10,
      )
    )
   );

   /***********************************  Starting Feature Section **********************************************/

   $wp_customize->add_section('education_minimal_feature_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Feature Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  // Enable/Disable
  $wp_customize->add_setting('education_minimal_feature_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_feature_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Feature Section','education-minimal'),
            'section'       =>  'education_minimal_feature_setups',
            'setting'       =>  'education_minimal_feature_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

    // Feature Page Three
  $wp_customize->add_setting('education_minimal_feature_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_feature_page',
    array(
      'priority'=>    2,
      'label'   =>    esc_html__( 'Select Page For Feature Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Feature Title & Description .','education-minimal'),
      'section' =>    'education_minimal_feature_setups',
      'setting' =>    'education_minimal_feature_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  //Select Category For Feature Section
 

    $wp_customize->add_setting('education_minimal_feature_section_cat',
      array(
          'default'           =>  '0',
          'sanitize_callback' =>  'education_minimal_sanitize_category_select',
          )
        );
      $wp_customize->add_control('education_minimal_feature_section_cat',
            array(
              'priority'      =>  3,
              'label'         =>  esc_html__('Select Category For Feature Section ','education-minimal'),
              'section'       =>  'education_minimal_feature_setups',
              'setting'       =>  'education_minimal_feature_section_cat',
              'type'          =>  'select',
              'choices'       =>  $education_minimal_category_lists,
          )
        );
  //Feature Read More Text

  $wp_customize->add_setting('education_minimal_feature_readmore',
    array(
        'default'           =>  esc_html__('View Detail','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('education_minimal_feature_readmore',
    array(
        'priority'      =>  3,
        'label'         =>  esc_html__('View Detail','education-minimal'),
        'section'       =>  'education_minimal_feature_setups',
        'setting'       =>  'education_minimal_feature_readmore',
        'type'          =>  'text',  
      )                                     
  );
   // Feature Post Number Count

  $wp_customize->add_setting('education_minimal_feature_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_feature_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Feature Category','education-minimal'),
        'section' => 'education_minimal_feature_setups',
        'setting' => 'education_minimal_feature_post_num',
        'priority'      =>  4,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );

    //Feature Read More Text
  $wp_customize->add_setting('education_minimal_feature_readmore_courses',
    array(
        'default'           =>  esc_html__('View All Courses','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('education_minimal_feature_readmore_courses',
    array(
        'priority'      =>  5,
        'label'         =>  esc_html__('view all courses','education-minimal'),
        'section'       =>  'education_minimal_feature_setups',
        'setting'       =>  'education_minimal_feature_readmore_courses',
        'type'          =>  'text',  
      )                                     
  );

  $wp_customize->add_setting('education_minimal_feature_super_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_feature_super_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Feature Section Comment and Author','education-minimal'),
            'section'       =>  'education_minimal_feature_setups',
            'setting'       =>  'education_minimal_feature_super_option',
            'priority'      =>  6,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );
  
 /***********************************  Starting Testimonial Section **********************************************/

   $wp_customize->add_section('education_minimal_testimonial_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Testimonial Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Testimonial  Enable/Disable
  $wp_customize->add_setting('education_minimal_testimonial_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_testimonial_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Feature Section','education-minimal'),
            'section'       =>  'education_minimal_testimonial_setups',
            'setting'       =>  'education_minimal_testimonial_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  //Select Category For Testimonial Section

  $wp_customize->add_setting('education_minimal_testimonial_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_testimonial_section_cat',
        array(
        'priority'      =>  3,
        'label'         =>  esc_html__('Select Category For Testimonial Section ','education-minimal'),
        'section'       =>  'education_minimal_testimonial_setups',
        'setting'       =>  'education_minimal_testimonial_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );

     // Testimonial Post Number Count

  $wp_customize->add_setting('education_minimal_testimonial_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_testimonial_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Feature Category','education-minimal'),
        'section' => 'education_minimal_testimonial_setups',
        'setting' => 'education_minimal_testimonial_post_num',
        'priority'      =>  4,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );
   // Background Image For Testimonial Sections
    $wp_customize->add_setting('education_minimal_testimonial_bg_image',
    array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_testimonial_bg_image',
  array(
      'label'      => esc_html__( 'Background Image', 'education-minimal' ),
       'description'   =>  esc_html__('This Will Upload Image For Background On Testimonial Section .','education-minimal'),
      'section'    => 'education_minimal_testimonial_setups',
      'settings'   => 'education_minimal_testimonial_bg_image',
      'priority' => 10,
      )
    )
   );


 /***********************************  Starting Team Section **********************************************/

   $wp_customize->add_section('education_minimal_team_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Team Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Team  Enable/Disable
  $wp_customize->add_setting('education_minimal_team_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_team_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Team Section','education-minimal'),
            'section'       =>  'education_minimal_team_setups',
            'setting'       =>  'education_minimal_team_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

    // Team Page Three
  $wp_customize->add_setting('education_minimal_team_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_team_page',
    array(
      'priority'=>    2,
      'label'   =>    esc_html__( 'Select Page For Feature Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Team Title & Description .','education-minimal'),
      'section' =>    'education_minimal_team_setups',
      'setting' =>    'education_minimal_team_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  //Select Category For Header Ticker Section

  $wp_customize->add_setting('education_minimal_team_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_team_section_cat',
        array(
        'priority'      =>  2,
        'label'         =>  esc_html__('Select Category','education-minimal'),
        'section'       =>  'education_minimal_team_setups',
        'setting'       =>  'education_minimal_team_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );
  // Team Post Number Count

  $wp_customize->add_setting('education_minimal_team_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_team_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Team Category','education-minimal'),
        'section' => 'education_minimal_team_setups',
        'setting' => 'education_minimal_team_post_num',
        'priority'      =>  3,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );
    //Team Read More Text
  $wp_customize->add_setting('education_minimal_team_readmore',
    array(
        'default'           =>  esc_html__('Read More','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('education_minimal_team_readmore',
    array(
        'priority'      =>  4,
        'label'         =>  esc_html__('Read More','education-minimal'),
        'section'       =>  'education_minimal_team_setups',
        'setting'       =>  'education_minimal_team_readmore',
        'type'          =>  'text',  
      )                                     
  );


 /***********************************  Starting Pro  Section **********************************************/

   $wp_customize->add_section('education_minimal_pro_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Promotional Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  // Enable/Disable
  $wp_customize->add_setting('education_minimal_pro_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_pro_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Promotional Section','education-minimal'),
            'section'       =>  'education_minimal_pro_setups',
            'setting'       =>  'education_minimal_pro_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  //Select Category For Prootional Section

  $wp_customize->add_setting('education_minimal_pro_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_pro_section_cat',
        array(
        'priority'      =>  3,
        'label'         =>  esc_html__('Select Category For Promotional Section ','education-minimal'),
        'section'       =>  'education_minimal_pro_setups',
        'setting'       =>  'education_minimal_pro_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );

    // Promotional Post Number Count
  $wp_customize->add_setting('education_minimal_pro_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_pro_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Pro Category','education-minimal'),
        'section' => 'education_minimal_pro_setups',
        'setting' => 'education_minimal_pro_post_num',
        'priority'      =>  4,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );
    //Pro Read More Text
  $wp_customize->add_setting('eduction_minimal_pro_readmore',
    array(
        'default'           =>  esc_html__('Apply Now','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('eduction_minimal_pro_readmore',
    array(
        'priority'      =>  5,
        'label'         =>  esc_html__('Apply Now','education-minimal'),
        'section'       =>  'education_minimal_pro_setups',
        'setting'       =>  'eduction_minimal_pro_readmore',
        'type'          =>  'text',  
      )                                     
  );

  $wp_customize->add_setting('education_minimal_pro_image',
  array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw'
  )
);
$wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_pro_image',
  array(
    'label'      => esc_html__( 'Promotional Background  Image ', 'education-minimal' ),
    'section'    => 'education_minimal_pro_setups',
    'settings'   => 'education_minimal_pro_image',
    'priority' => 9,
  )
  )
  );
  
 /***********************************  Starting Events  Section **********************************************/

   $wp_customize->add_section('education_minimal_events_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Events Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Events Enable/Disable
  $wp_customize->add_setting('education_minimal_events_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_events_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Events Section','education-minimal'),
            'section'       =>  'education_minimal_events_setups',
            'setting'       =>  'education_minimal_events_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  // Events Page Three
  $wp_customize->add_setting('education_minimal_events_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_events_page',
    array(
      'priority'=>    2,
      'label'   =>    esc_html__( 'Select Page For Events Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Team Title & Description .','education-minimal'),
      'section' =>    'education_minimal_events_setups',
      'setting' =>    'education_minimal_events_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  //Select Category For events

  $wp_customize->add_setting('education_minimal_eventssection_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_eventssection_cat',
        array(
        'priority'      =>  3,
        'label'         =>  esc_html__('Select Category For Events Section ','education-minimal'),
        'section'       =>  'education_minimal_events_setups',
        'setting'       =>  'education_minimal_eventssection_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );
    // Events Number Count
  $wp_customize->add_setting('education_minimal_events_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_events_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Events Section','education-minimal'),
        'section' => 'education_minimal_events_setups',
        'setting' => 'education_minimal_events_post_num',
        'priority'      =>  4,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );

  //Events Read More Text
  $wp_customize->add_setting('education_minimal_pro_readmore',
    array(
        'default'           =>  esc_html__('Apply Now','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('education_minimal_pro_readmore',
    array(
        'priority'      =>  5,
        'label'         =>  esc_html__('Apply Now','education-minimal'),
        'section'       =>  'education_minimal_events_setups',
        'setting'       =>  'education_minimal_pro_readmore',
        'type'          =>  'text',  
      )                                     
  );

  //Events Enable/Disable
  $wp_customize->add_setting('education_minimal_events_calender_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_events_calender_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Events Section Date','education-minimal'),
            'section'       =>  'education_minimal_events_setups',
            'setting'       =>  'education_minimal_events_calender_option',
            'priority'      =>  6,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );
  
   /***********************************  Starting Call To  Section **********************************************/

   $wp_customize->add_section('education_minimal_cta_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Call To Action Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Pro  Enable/Disable
  $wp_customize->add_setting('education_minimal_cta_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_cta_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Call To Section','education-minimal'),
            'section'       =>  'education_minimal_cta_setups',
            'setting'       =>  'education_minimal_cta_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );
  $wp_customize->add_setting('education_minimal_process_page_video',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
    )
  );

  $wp_customize->add_control('education_minimal_process_page_video',
    array(
      'priority'=>    2,
      'label'   =>    esc_html__( 'Feature Image For Video Page','education-minimal' ),
      'section' =>    'education_minimal_cta_setups',
      'setting' =>    'education_minimal_process_page_video',
      'type'    =>    'dropdown-pages',
      )                                     
  );      
    // Call To  Read More Text
  $wp_customize->add_setting('callto_read_more',
    array(
        'default'           =>  esc_html__('Read More','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('callto_read_more',
    array(
        'priority'      =>  3,
        'label'         =>  esc_html__('Call To Action Read More','education-minimal'),
        'section'       =>  'education_minimal_cta_setups',
        'setting'       =>  'callto_read_more',
        'type'          =>  'text',  
      )                                     
  );
  $wp_customize->add_setting('education_minimal_frontpage_vedio_option',
    array(
          'capability'        => 'edit_theme_options',
          'default'           => '',
          'sanitize_callback' => 'esc_url_raw',
      )
  );

  $wp_customize->add_control('education_minimal_frontpage_vedio_option',
    array(
      'priority'      =>  4,
      'label'         => esc_html__( 'Type Video URL For Video Section.', 'education-minimal' ),
      'description'   => esc_html__( 'Use Link from youtube', 'education-minimal' ),
      'section'       => 'education_minimal_cta_setups',
      'settings'      => 'education_minimal_frontpage_vedio_option',
      'type'          => 'url'
    )
  );
  $wp_customize->add_setting('education_minimal_bg_image',
  array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw'
  )
);
$wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_bg_image',
  array(
    'label'      => esc_html__( 'Call To Background Image ', 'education-minimal' ),
    'section'    => 'education_minimal_cta_setups',
    'settings'   => 'education_minimal_bg_image',
    'priority' => 5,
    )
  )
);

/***********************************  Starting Blogs  Section **********************************************/


   $wp_customize->add_section('education_minimal_blog_setups',
    array(
      'priority' => '2',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Blog Section','education-minimal'),
      'panel' => 'education_minimal_homepage_setups'
    ));

  //Pro  Enable/Disable
  $wp_customize->add_setting('education_minimal_blog_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_blog_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Blogs Section','education-minimal'),
            'section'       =>  'education_minimal_blog_setups',
            'setting'       =>  'education_minimal_blog_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  //Page
  $wp_customize->add_setting('education_minimal_blog_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_blog_page',
    array(
      'priority'=>    2,
      'label'   =>    esc_html__( 'Select Page For Blog Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Blog Title , Description And Feature Image  .','education-minimal'),
      'section' =>    'education_minimal_blog_setups',
      'setting' =>    'education_minimal_blog_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );

  //Select Category For Blog Section

  $wp_customize->add_setting('education_minimal_blog_section_cat',
    array(
        'default'           =>  '0',
        'sanitize_callback' =>  'education_minimal_sanitize_category_select',
        )
      );
  $wp_customize->add_control('education_minimal_blog_section_cat',
        array(
        'priority'      =>  3,
        'label'         =>  esc_html__('Select Category For Blog Section ','education-minimal'),
        'section'       =>  'education_minimal_blog_setups',
        'setting'       =>  'education_minimal_blog_section_cat',
        'type'          =>  'select',
        'choices'       =>  $education_minimal_category_lists,
      )
    );

  // Blog Post Number Count
  $wp_customize->add_setting('education_minimal_blog_post_num', 
      array(
        'default' => '5',
          'sanitize_callback' => 'education_minimal_integer_sanitize',
      )
  );
    
  $wp_customize->add_control('education_minimal_blog_post_num',
    array(
        'type' => 'number',
        'label' => esc_html__('No. of Post On Blog Category','education-minimal'),
        'section' => 'education_minimal_blog_setups',
        'setting' => 'education_minimal_blog_post_num',
        'priority'      =>  4,
        'input_attrs' => array(
        'min' => 1,
        'max' => 9,
      ),
    )
  );
  // Blog  Read More Text
  $wp_customize->add_setting('education_minimal_blog_read_more',
    array(
        'default'           =>  esc_html__('Read More','education-minimal'),
        'sanitize_callback' =>  'sanitize_text_field',
      )
  );

  $wp_customize->add_control('education_minimal_blog_read_more',
    array(
        'priority'      =>  3,
        'label'         =>  esc_html__('Blog Read More','education-minimal'),
        'section'       =>  'education_minimal_blog_setups',
        'setting'       =>  'education_minimal_blog_read_more',
        'type'          =>  'text',  
      )                                     
  );

   /***********************************  Starting Footer Settings **********************************************/

  $wp_customize->add_panel('education_minimal_footer_setups',
  array(
    'priority' => '90',
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => esc_html__('Footer Setting ','education-minimal'),
  ));

    /***********************************  Starting Footer Sections  **********************************************/

  $wp_customize->add_section('education_mnimal_footer_setups',
    array(
      'priority' => '1',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Top Footer Section','education-minimal'),
      'panel' => 'education_minimal_footer_setups'
    ));

  //Header Footer Social Settings

  $wp_customize->add_setting('education_minimal_footer_social_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_footer_social_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Footer Social ','education-minimal'),
            'section'       =>  'education_mnimal_footer_setups',
            'setting'       =>  'education_minimal_footer_social_option',
            'priority'      =>  1,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  $wp_customize->add_setting('education_minimal_footer_bg_image',
    array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_footer_bg_image',
    array(
      'label'      => esc_html__( ' Footer Background Image ', 'education-minimal' ),
      'section'    => 'education_mnimal_footer_setups',
      'settings'   => 'education_minimal_footer_bg_image',
      'priority' => 10,
    )
  )
  );
  //Top Footer Social Settings

  $wp_customize->add_setting('education_minimal_top_footer_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_top_footer_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Top Footer ','education-minimal'),
            'section'       =>  'education_mnimal_footer_setups',
            'setting'       =>  'education_minimal_top_footer_option',
            'priority'      =>  11,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );

  //Last Footer Settings
  $wp_customize->add_setting('education_minimal_last_footer_option',
        array(
            'default'           =>  'no',
            'sanitize_callback' =>  'education_minimal_sanitize_option',
            )
        );
  $wp_customize->add_control('education_minimal_last_footer_option',
      array(
            'description'   =>  esc_html__('Enable/Disable Below Footer ','education-minimal'),
            'section'       =>  'education_mnimal_footer_setups',
            'setting'       =>  'education_minimal_last_footer_option',
            'priority'      =>  11,
            'type'          =>  'radio',
            'choices'        =>  array(
                'yes'   =>  esc_html__('Yes','education-minimal'),
                'no'    =>  esc_html__('No','education-minimal')
              )
         )
     );
  /***********************************  Footer Copy Right **********************************************/

   $wp_customize->add_section('education_minimal_footer_optons_setupsss',
  array(
    'priority' => '2',
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => esc_html__(' Footer  Copyright','education-minimal'),
    'panel' => 'education_minimal_footer_setups'
  ));
  $wp_customize->add_setting( 'education_minimal_copyright_text',
    array(
      'default' => esc_html__( '2018 Education Minimal Pro', 'education-minimal' ),
      'sanitize_callback' => 'sanitize_text_field',
    )
  );
  $wp_customize->add_control('education_minimal_copyright_text',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Copyright Text', 'education-minimal' ),
      'section' => 'education_minimal_footer_optons_setupsss',
      'priority' => 5
    )
  );

  /***********************************  Starting Top Footer Sections  **********************************************/

  $wp_customize->add_section('education_mnimal_last_footer_setups',
    array(
      'priority' => '45',
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => esc_html__('Footer Section','education-minimal'),
      'panel' => 'education_minimal_footer_setups'
    ));

    // Footer Page
  $wp_customize->add_setting('education_minimal_footer_one_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_footer_one_page',
    array(
      'priority'=>    3,
      'label'   =>    esc_html__( 'Select Page For Footer Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Foter  Title And Feature Image  .','education-minimal'),
      'section' =>    'education_mnimal_last_footer_setups',
      'setting' =>    'education_minimal_footer_one_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );

    //footer Page Link
    $wp_customize->add_setting('education_minimal_footer_page_link_one',
      array(
            'default'           =>  esc_html__('# ','education-minimal'),
            'sanitize_callback' =>  'esc_url_raw',
             )
      );

    $wp_customize->add_control('education_minimal_footer_page_link_one',
      array(
            'priority'      =>  4,
            'label'         =>  esc_html__('Footer Page Link One','education-minimal'),
            'section'       =>  'education_mnimal_last_footer_setups',
            'setting'       =>  'education_minimal_footer_page_link_one',
            'type'          =>  'text',  
        )                                     
   );
     // Footer Page
  $wp_customize->add_setting('education_minimal_footer_two_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_footer_two_page',
    array(
      'priority'=>    5,
      'label'   =>    esc_html__( 'Select Page For Footer Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Foter  Title And Feature Image  .','education-minimal'),
      'section' =>    'education_mnimal_last_footer_setups',
      'setting' =>    'education_minimal_footer_two_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );

      //footer Page Link
    $wp_customize->add_setting('education_minimal_footer_page_link_two',
      array(
            'default'           =>  esc_html__('# ','education-minimal'),
            'sanitize_callback' =>  'esc_url_raw',
             )
      );

    $wp_customize->add_control('education_minimal_footer_page_link_two',
      array(
            'priority'      =>  6,
            'label'         =>  esc_html__('Footer Page Link Two','education-minimal'),
            'section'       =>  'education_mnimal_last_footer_setups',
            'setting'       =>  'education_minimal_footer_page_link_two',
            'type'          =>  'text',  
        )                                     
   );
  // Footer Page
  $wp_customize->add_setting('education_minimal_footer_three_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_footer_three_page',
    array(
      'priority'=>    6,
      'label'   =>    esc_html__( 'Select Page For Footer Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Foter  Title And Feature Image  .','education-minimal'),
      'section' =>    'education_mnimal_last_footer_setups',
      'setting' =>    'education_minimal_footer_three_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );
    //footer Page Link
    $wp_customize->add_setting('education_minimal_footer_page_link_three',
      array(
            'default'           =>  esc_html__('# ','education-minimal'),
            'sanitize_callback' =>  'esc_url_raw',
             )
      );

    $wp_customize->add_control('education_minimal_footer_page_link_three',
      array(
            'priority'      =>  7,
            'label'         =>  esc_html__('Footer Page Link Three','education-minimal'),
            'section'       =>  'education_mnimal_last_footer_setups',
            'setting'       =>  'education_minimal_footer_page_link_three',
            'type'          =>  'text',  
        )                                     
   );
  // Footer Page
  $wp_customize->add_setting('education_minimal_footer_four_page',
    array(
      'default'           =>  0,
      'sanitize_callback' =>  'education_minimal_sanitize_dropdown_pages',
   )
  );

  $wp_customize->add_control('education_minimal_footer_four_page',
    array(
      'priority'=>    8,
      'label'   =>    esc_html__( 'Select Page For Footer Section','education-minimal' ),
      'description'   =>  esc_html__('This Page Will Display Foter  Title And Feature Image  .','education-minimal'),
      'section' =>    'education_mnimal_last_footer_setups',
      'setting' =>    'education_minimal_footer_four_page',
      'type'    =>    'dropdown-pages',
     )                                     
    );
      //footer Page Link
    $wp_customize->add_setting('education_minimal_footer_page_link_four',
      array(
            'default'           =>  esc_html__('# ','education-minimal'),
            'sanitize_callback' =>  'esc_url_raw',
             )
      );

    $wp_customize->add_control('education_minimal_footer_page_link_four',
      array(
            'priority'      =>  9,
            'label'         =>  esc_html__('Footer Page Link Four','education-minimal'),
            'section'       =>  'education_mnimal_last_footer_setups',
            'setting'       =>  'education_minimal_footer_page_link_four',
            'type'          =>  'text',  
        )                                     
   );
  $wp_customize->add_setting('education_minimal_footer_background_image',
    array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize,'education_minimal_footer_background_image',
    array(
      'label'      => esc_html__( 'Footer Background Image ', 'education-minimal' ),
      'section'    => 'education_mnimal_last_footer_setups',
      'settings'   => 'education_minimal_footer_background_image',
      'priority' => 10,
    )
  )
  );

  /***********************************  Archive Settings **********************************************/


$wp_customize->add_panel('education_minimal_archive_section', 
  array(
    'capabitity' => 'edit_theme_options',
    'priority' => 38,
    'title' => __('Archive Page Settings', 'education-minimal')
    )
);

$wp_customize->add_section('education_minimal_archive',
      array(
        'title' => __('Archive Sidebar Settings', 'education-minimal'),
        'panel' => 'education_minimal_archive_section'
        )
    );

  $wp_customize->add_setting('education_minimal_archive_setting_sidebar_option',
      array(
        'default' =>  'sidebar-right',
        'sanitize_callback' =>  'education_minimal_radio_sanitize_archive_sidebar'
        )
      );  

  $wp_customize->add_control('education_minimal_archive_setting_sidebar_option',
      array(
        'description' => __('Choose the sidebar Layout for the archive page','education-minimal'),
        'section' => 'education_minimal_archive',
        'type'    =>  'radio',
        'choices' =>  array(
            'sidebar-left' =>  __('Sidebar Left','education-minimal'),
            'sidebar-right' =>  __('Sidebar Right','education-minimal'),
            'sidebar-both' =>  __('Sidebar Both','education-minimal'),
            'sidebar-no' =>  __('Sidebar No','education-minimal'),
          )
        )
    );

  $wp_customize->add_setting('education_minimal_section_date',
      array(
          'default'           =>  'no',
          'sanitize_callback' =>  'education_minimal_sanitize_option',
          )
      );
  $wp_customize->add_control('education_minimal_section_date',array(
          'description'   =>  esc_html__('Enable/Disable Date On Single Post','education-minimal'),
          'section'       =>  'education_minimal_archive',
          'setting'       =>  'education_minimal_section_date',
          'priority'      =>  3,
          'type'          =>  'radio',
          'choices'        =>  array(
              'yes'   =>  esc_html__('Yes','education-minimal'),
              'no'    =>  esc_html__('No','education-minimal')
              )
          )
      );
    $wp_customize->add_setting('education_minimal_archive_section_redmore_optons',
      array(
        'default'           =>  'no',
        'sanitize_callback' =>  'education_minimal_sanitize_option',
      )
    );
    $wp_customize->add_control('education_minimal_archive_section_redmore_optons',
      array(
        'description'   =>  esc_html__('Enable/Disable Read More','education-minimal'),
        'section'       =>  'education_minimal_archive',
        'setting'       =>  'education_minimal_archive_section_redmore_optons',
        'priority'      =>  5,
        'type'          =>  'radio',
        'choices'        =>  array(
        'yes'   =>  esc_html__('Yes','education-minimal'),
        'no'    =>  esc_html__('No','education-minimal')
      )
    )
    );
    $wp_customize->add_setting('education_minimal_archive_submit',array(
                  'default'           =>  esc_html__('Read More ','education-minimal'),
                  'sanitize_callback' =>  'sanitize_text_field',
                  )
              );

   $wp_customize->add_control('education_minimal_archive_submit',array(
                  'priority'      =>  4,
                  'label'         =>  esc_html__('Read More ','education-minimal'),
                  'section'       =>  'education_minimal_archive',
                  'setting'       =>  'education_minimal_archive_submit',
                  'type'          =>  'text',  
                  )                                     
              );
   $wp_customize->add_setting('pagination_theme_options', 
    array(
    'default'       => 'default',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'education_minimal_sanitize_select'
    )
   );

   $wp_customize->add_control('pagination_theme_options', 
    array(    
    'label'   => esc_html__('Pagination Options', 'education-minimal'),
    'section'   => 'education_minimal_archive',
    'settings'  => 'pagination_theme_options',
    'type'    => 'radio',
    'choices'   => array(   
      'default'     => esc_html__('Default', 'education-minimal'),             
      'numeric'     => esc_html__('Numeric', 'education-minimal'),   
      ),  
    )
   );

    
  }
add_action( 'customize_register', 'education_minimal_custom_customize_register' );