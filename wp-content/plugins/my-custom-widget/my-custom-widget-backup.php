<?php
/**
 * Plugin Name: My Custom Widget
 * Description: A custom widget to display recent or popular posts.
 * Version: 1.0
 * Author: Your Name
 */

// Register the widget
function my_custom_widget_register() {
    register_widget('My_Custom_Widget');
}
add_action('widgets_init', 'my_custom_widget_register');

// Define the widget class
class My_Custom_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'my_custom_widget', // Base ID
            'My Custom Widget', // Name
            array('description' => __('A custom widget to display recent or popular posts'))
        );
    }

    // Widget form creation in the admin panel
    public function form($instance) {
        // Retrieve saved values
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $display_type = !empty($instance['display_type']) ? $instance['display_type'] : 'recent';
        $num_posts = !empty($instance['num_posts']) ? $instance['num_posts'] : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Display type:'); ?></label>
            <select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
                <option value="recent" <?php selected($display_type, 'recent'); ?>><?php _e('Recent Posts'); ?></option>
                <option value="popular" <?php selected($display_type, 'popular'); ?>><?php _e('Popular Posts'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e('Number of posts:'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($num_posts); ?>" size="3">
        </p>
        <?php
    }

    // Update widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : 'recent';
        $instance['num_posts'] = (!empty($new_instance['num_posts'])) ? (int) $new_instance['num_posts'] : 5;
        return $instance;
    }

    // Display the widget content on the frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        // Display the widget title if set
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Fetch posts based on the display type
        $query_args = array(
            'posts_per_page' => !empty($instance['num_posts']) ? (int) $instance['num_posts'] : 5,
            'orderby' => $instance['display_type'] == 'popular' ? 'comment_count' : 'date',
            'order' => 'DESC',
        );
        $posts = new WP_Query($query_args);

        // Display posts in a list
        if ($posts->have_posts()) {
            echo '<ul>';
            while ($posts->have_posts()) {
                $posts->the_post();
                echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No posts found.') . '</p>';
        }

        // Reset post data
        wp_reset_postdata();

        echo $args['after_widget'];
    }
}
?>
