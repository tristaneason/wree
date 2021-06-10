<?php
/** 
 *
 * Top Footer 
 * @package Education_Minimal
 * 
 */

add_action('widgets_init', 'education_minimal_terms_register');

function education_minimal_terms_register() {
    register_widget('education_minimal_termsr_Widget');
}

class education_minimal_termsr_Widget extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'education_minimal_termsr_Widget',
        esc_html__('EDUCATION MINIMAL : Top Footer One','education-minimal'),
        array(
          'description' => esc_html__( 'This Widget show Top Footer Content', 'education-minimal' )
        )
      );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */

    private function widget_fields() {
        $fields = array(
            'term_title' => array(
                'education_minimal_widgets_name' => 'term_title',
                'education_minimal_widgets_title' => esc_html__('Top Footer Title', 'education-minimal'),
                'education_minimal_widgets_field_type' => 'text',
            ),

            'term_description' => array(
                'education_minimal_widgets_name' => 'term_description',
                'education_minimal_widgets_title' => esc_html__('Top Footer Description', 'education-minimal'),
                'education_minimal_widgets_field_type' => 'text',
            ),
        );

        return $fields;
    }

  	//===================================================================================================================//
 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        $title_widget = apply_filters( 'widget_title', empty( $instance['term_title'] ) ? '' : $instance['term_title'], $instance, $this->id_base );
        $term_description = isset( $instance['term_description'] ) ? $instance['term_description'] : '';
        
        echo wp_kses_post($before_widget);
        ?>
				<div class="widget social-links">
          <?php if($title_widget){ ?>
            <span class="entry-subtitle">
                <?php	echo  esc_html($title_widget);  ?>
            </span>
           <?php } ?>
           <?php if($term_description){ ?>
    					<h2 class="widget-title">
    							<?php echo esc_html($term_description); ?>
    					</h2>
          <?php } ?>
          <?php  if (get_theme_mod('education_minimal_social_menu_option','no')=='yes') {
            if ( has_nav_menu( 'social-media' ) ) : ?>
    					<ul>
    						<li>
                  <span>
      									<?php wp_nav_menu( array(
      									'theme_location'  => 'social-media',
      									'fallback_cb'     => 'wp_page_menu',
      									) ); ?>
                </span>
    						</li>
    					</ul>
            <?php endif; ?>
          <?php } ?>
				</div>
 
      <?php
      echo wp_kses_post($after_widget);
    }

    //===========================================  Saving Widgets Values  Functions ==================================//

   public function update($new_instance, $old_instance) {
          $instance = $old_instance;
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $instance[$education_minimal_widgets_name] = education_minimal_widgets_updated_field_value($widget_field, $new_instance[$education_minimal_widgets_name]);
          }
          return $instance;
      }
      
      public function form($instance) {

          $widget_fields = $this->widget_fields();

          foreach ($widget_fields as $widget_field) {

              extract($widget_field);
              $education_minimal_widgets_field_value = !empty($instance[$education_minimal_widgets_name]) ? $instance[$education_minimal_widgets_name] : '';
              education_minimal_widgets_show_widget_field($this, $widget_field, $education_minimal_widgets_field_value);
              
          }?>
           <?php if ( !has_nav_menu( 'social-media' ) ) : ?>
            <p><?php esc_html_e( 'Please set Social menu from menu section', 'education-minimal' );?></p>
          <?php endif;

      }
}