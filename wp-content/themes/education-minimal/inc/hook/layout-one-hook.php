<?php
/**
 * Education Minimal Pro functions and definitions
 *
 * @package Education_Minimal
 */

function education_minimal_header_callback(){
?>

<?php $header_ticker = get_theme_mod( 'header_tiker_text',esc_html__('NOTICE','education-minimal') ); ?>
<?php if(get_theme_mod( 'education_minimal_option','no' ) == 'yes'): ?>

	<div class="top-notification-bar">

		<div class="container">

			<!-- ***********************  Header Ticker **************************-->

			<?php if(!empty($header_ticker)){ ?>
		        <span class="notice-info-title"> <?php echo esc_html( $header_ticker );?> : </span>
		    <?php } ?>

			<!-- ****************************************  Header Ticker Caegory ****************************************-->

		    <?php $education_minimal_cat = get_theme_mod('education_minimal_ticker_section_cat'); 
		  	$number = get_theme_mod('education_minimal_post_num',10); ?>

			<?php
			if( !empty( $education_minimal_cat) ) {

			$loop = new WP_Query(
				array(
				'post_type' => 'post',    
				'category_name' => esc_html($education_minimal_cat),
				'posts_per_page' => absint( $number ),  
				)
			);
			}else{
			$loop = new WP_Query( array( 'post_type'=>'post','posts_per_page'=>absint( $number ), ) );
			}   
			?>
			<ul class="notice-info">
			<?php
				if($loop->have_posts() ) {

					while($loop->have_posts() ) {

					$loop->the_post(); ?>
						<li class="info-item"><?php the_title();?> </li>
					<?php 
		            }
		       		 wp_reset_postdata();
		 		   }
				?> 
			</ul>
			
		</div>
	</div>
<?php endif;   ?>
<div class="hgroup-wrap">
	<div class="container">

		<div class="row top-header">

		<!-- ****************************************  Starting Header Social  ****************************************-->

			<div class="custom-col-4">

				<div class="social-links">
					<ul>
						<?php  if (get_theme_mod('education_minimal_social_menu_option','no')=='yes') {

							if ( has_nav_menu( 'social-media' ) ) : ?>
							<?php wp_nav_menu( array(
							'theme_location'  => 'social-media',
							'fallback_cb'     => 'wp_page_menu',
							) ); ?>
							<?php endif; ?>


						<?php } ?>

					</ul>
				</div>
			</div>

			<!-- **************************************** Starting Header Search  ****************************************-->

			<div class="custom-col-8">
				<div class="header-section">
					<div class="search-section">
						<?php get_search_form();?>
					</div>
					<?php if(get_theme_mod( 'education_minimal_download_menu_option','no' ) == 'yes'): ?>
							<?php
							$education_minimal_button = get_theme_mod( 'education_minimal_download_text', esc_html__('Download', 'education-minimal') );
							$education_minimal_first_button_url = get_theme_mod( 'education_minimal_download_link', esc_url( home_url( '/' ).'#focus' ) );
							?>
							<?php if( !empty( $education_minimal_button ) ) { ?>

								<a  class="downloads" href="<?php echo esc_url($education_minimal_first_button_url); ?>">
								<?php echo esc_html($education_minimal_button); ?>
								</a>

							<?php } ?>
					<?php endif;   ?>
				</div>
			</div>

		</div>

		<div class="row main-header-wrap">

			<!-- ****************************************  Header Site Identity ****************************************-->

			<div class="custom-col-4">
				<section class="site-branding">
				<!-- site branding starting from here -->
				<h1 class="site-title">
				<?php $site_identity = get_theme_mod( 'site_identity_options', 'title-text' );

				$title = get_bloginfo( 'name', 'display' );
				$description    = get_bloginfo( 'description', 'display' );	

				if ( 'logo-only' == $site_identity ) { 
					if ( has_custom_logo() ){
					the_custom_logo();
					}
				} elseif ( 'logo-text' == $site_identity ) {
					if ( has_custom_logo() ) {
						the_custom_logo();
					}
					if ( $description ) {
						echo '<p class="site-description">'.esc_attr( $description ).'</p>';
					}
				} elseif ( 'title-only' == $site_identity && $title ) {

					if ( is_front_page() && is_home() ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php } else { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php }

				} elseif ( 'title-text' == $site_identity ) {
					if ( $title ) {
						if ( is_front_page() && is_home() ) { ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
						<?php } else { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php }
					}
					if ( $description ) {
					echo '<p class="site-description">'.esc_attr( $description ).'</p>';	
					}
				}
				?>	
				</h1>

				<!-- <span class="site-description">satisfied home</span> -->

				</section><!-- site branding ends here -->
			</div>

			<div class="custom-col-8">

				<div id="navbar" class="navbar">
					<nav id="site-navigation" class="navigation main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'education-minimal' ); ?>
						</button>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary',
							'container_class' => 'menu-container',
						) );
						?>
					</nav><!-- main-navigation ends here -->

					<?php
					$education_minimal_inquery = get_theme_mod( 'education_minimal_download_inquery_text', esc_html__('Inquery', 'education-minimal') );
					$education_minimal_inquery_url = get_theme_mod( 'education_minimal_inquery_link', esc_url( home_url( '/' ).'#focus' ) );
					?>

					<div class="enquiry">
						<?php if( !empty( $education_minimal_inquery ) ) { ?>
							<a href="<?php echo esc_url($education_minimal_inquery_url); ?>">
								<span><?php echo esc_html($education_minimal_inquery); ?></span>
							</a>
						<?php } ?>

					</div>

				</div>

			<!-- navbar ends here -->
			</div>

		</div>
	</div>
</div>

<?php	
}
add_action('education_minimal_main_header_callback_action','education_minimal_header_callback');