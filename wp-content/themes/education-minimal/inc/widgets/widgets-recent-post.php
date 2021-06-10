<?php
/**
* Recent Post Widgets Section
*
* @package Education_Minimal
* 
*/

/**
 * Adds Recent post display widget.
 */

add_action( 'widgets_init', 'education_minimal_register_recent_posts_widget' );
function education_minimal_register_recent_posts_widget() {
    register_widget( 'education_minimal_recent_posts_widget' );
}
class education_minimal_recent_posts_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'education_minimal_recent_posts',
			esc_html__('EDUCATION MINIMAL : Recent Posts','education-minimal'),
			array(
				'description'	=> esc_html__( 'A widget To Display Recent Posts', 'education-minimal' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
        $education_minimal_category_lists 	=	education_minimal_category_lists();
		$fields = array(
            'recent_post_title' => array(
                'education_minimal_widgets_name' => 'recent_post_title',
                'education_minimal_widgets_title' => esc_html__('Title','education-minimal'),
                'education_minimal_widgets_field_type' => 'text',
            ),
            'recent_post_category' => array(
                'education_minimal_widgets_name' => 'recent_post_category',
                'education_minimal_widgets_title' => esc_html__('Recent Post Category','education-minimal'),
                'education_minimal_widgets_field_type' => 'select',
                'education_minimal_widgets_description' => esc_html__('If you leave recent category empty widget will show recent posts','education-minimal'),
                'education_minimal_widgets_field_options' => $education_minimal_category_lists,
            ),
			'recent_post_show_num' => array(
                'education_minimal_widgets_name' => 'recent_post_show_num',
                'education_minimal_widgets_title' => esc_html__('No of posts to show','education-minimal'),
                'education_minimal_widgets_field_type' => 'number',
                'education_minimal_widgets_description' => esc_html__('Displays the latest five post if left empty','education-minimal'),
            ),
            'recent_post_show_img' => array(
                'education_minimal_widgets_name' => 'recent_post_show_img',
                'education_minimal_widgets_title' => esc_html__('Display post image','education-minimal'),
                'education_minimal_widgets_field_type' => 'checkbox',
            ),
		);
		
		return $fields;
	 }


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
        extract($args);
        $title_widget = isset( $instance['recent_post_title'] ) ? $instance['recent_post_title'] : '';    
        $post_num = isset( $instance['recent_post_show_num'] ) ? $instance['recent_post_show_num'] : '5' ;
        $recent_post_category = isset( $instance['recent_post_category'] ) ? $instance['recent_post_category'] : '' ;
        $show_img = isset($instance['recent_post_show_img']) ? $instance['recent_post_show_img'] : '';
       
        echo $before_widget;
        
        	$recent_post_query = new WP_Query(array('post_type' =>'post','category_name' => esc_html($recent_post_category),'posts_per_page' => absint( $number ),'order' => 'DESC','status' => 'publish'));

            if (!empty($title_widget)):
                echo $args['before_title'] . esc_html($title_widget) . $args['after_title'];
            endif;
            
            if($recent_post_query->have_posts()) : ?>
                <?php while($recent_post_query->have_posts()) : $recent_post_query->the_post(); ?>
                
                <div class="recent-post-wrap">
                    
                    <?php if($show_img):
                    
                        $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-minimal-recent-post-thumb', false ); 
                        if($img_src[0]){ ?>
                            <div class="image_wrap_recent">
                               <img src="<?php echo esc_url($img_src[0]);?>" />
                            </div>
                        <?php } ?>
                    
                    <?php endif; ?>
                    
                    <div class="recent-post-content">
                        <?php if(get_the_title()){ ?>
                            <a href="<?php the_permalink(); ?>" class="recent-post-title-widget"><?php the_title(); ?></a>
                        <?php } ?>
                        <span class="date_recent_post"><?php echo esc_html(wp_trim_words(get_the_content(),10,'...')); ?></span>
                    </div>
                    
                </div>
                
                <?php endwhile;
                wp_reset_postdata();
            endif; 
            
        echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	education_minimal_widgets_updated_field_value()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {

			extract( $widget_field );
	
			// Use helper function to get updated field values
			$instance[$education_minimal_widgets_name] = education_minimal_widgets_updated_field_value( $widget_field, $new_instance[$education_minimal_widgets_name] );
			
		}
				
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param	array $instance Previously saved values from database.
	 *
	 * @uses	education_minimal_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			// Make array elements available as variables 
			extract( $widget_field );
			$education_minimal_widgets_field_value = isset( $instance[$education_minimal_widgets_name] ) ? esc_attr( $instance[$education_minimal_widgets_name] ) : '';
			education_minimal_widgets_show_widget_field( $this, $widget_field, $education_minimal_widgets_field_value );
		}	
	}
}