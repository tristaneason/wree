<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Home Page
 * @package Education_Minimal
 */
get_header(); ?>

        <div id="primary" class="content-area">

                <main id="main" class="site-main" role="main">
	            	<?php
	        	  	/** About Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'about' );

	          	  	/** Counter Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'counter' );

	          	  	/** Counter Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'feature' );

	          	  	/** Testimonial Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'testimonial' );

  	  				/** Team Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'team' );

  	  				/** Promotional Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'pro' );

	          	  	/** Events Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'events' );

          	  		/** Call To Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'call-to' );

          	  		/** Blog Section **/
	          	  	get_template_part( 'template-parts/sections/section', 'blog' );
	          	  ?>
                </main><!-- #main -->
        </div><!-- #primary -->
<?php get_footer();