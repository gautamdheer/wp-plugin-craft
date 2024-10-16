<?php

class My_Custom_Widget extends WP_Widget{

    public function __construct(){
        parent::__construct(
            "my_custom_widget",
            "My Custom Widget",
            array("description"=> "Display Recent Posts and Static Message"));
    }

    // Display widget to admin panel
    public function form( $instance ) {
        $mcw_title = isset($instance['mcw_title']) ? $instance['mcw_title'] : '';
        $mcw_display_type = isset($instance['mcw_display_type']) ? $instance['mcw_display_type'] : 'recent_posts';
        $mcw_number_of_post = isset($instance['mcw_number_of_post']) ? $instance['mcw_number_of_post'] : '';
        $mcw_message = isset($instance['mcw_message']) ? $instance['mcw_message'] : '';        
    ?>
       
        <p>
            <label for="<?php echo $this->get_field_id('mcw_title') ?>">Title</label>
            <input type="text" name="<?php echo $this->get_field_name('mcw_title') ?>"
                id="<?php echo $this->get_field_id('mcw_title') ?>" class="widefat" value="<?php echo $mcw_title; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mcw_display_type') ?>">Display type</label>
            <select name="<?php echo $this->get_field_name('mcw_display_type') ?>"
                id="<?php echo $this->get_field_id('mcw_display_type') ?>" class="mcw_dd_option widefat">
                <option <?php if($mcw_display_type=='recent_posts') {echo 'selected'; } ?> value="recent_posts">Recent Posts
                </option>
                <option <?php if($mcw_display_type=='static_message') {echo 'selected'; } ?> value="static_message">Static
                    Message</option>
            </select>
        </p>
        <p id="mcw_display_recent_post"
            <?php if($mcw_display_type == "recent_posts") { } else{ echo 'class="hide-element"'; } ?>>
            <label for="<?php echo $this->get_field_id('mcw_number_of_post') ?>">Number of posts</label>
            <input type="number" name="<?php echo $this->get_field_name('mcw_number_of_post') ?>"
                id="<?php echo $this->get_field_id('mcw_number_of_post') ?>" class="widefat" value="<?php echo $mcw_number_of_post; ?>">
        </p>
        <p id="mcw_static_message"
            <?php if($mcw_display_type == "static_message") { } else{ echo 'class="hide-element"'; } ?>>
            <label for="<?php echo $this->get_field_id('mcw_message') ?>">Your Message</label>
            <input type="text" name="<?php echo $this->get_field_name('mcw_message') ?>"
                id="<?php echo $this->get_field_id('mcw_message') ?>" class="widefat" value="<?php echo $mcw_message; ?>">
        </p>
   

    <?php
    }
    
    // Save widgets setting to the Wordpress
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['mcw_title'] = !empty($new_instance['mcw_title']) ? sanitize_text_field($new_instance['mcw_title']) : '';
        $instance['mcw_display_type'] = !empty($new_instance['mcw_display_type']) ? sanitize_text_field($new_instance['mcw_display_type']) : 'recent_posts';
        $instance['mcw_number_of_post'] = !empty($new_instance['mcw_number_of_post']) ? intval($new_instance['mcw_number_of_post']) : '';
        $instance['mcw_message'] = !empty($new_instance['mcw_message']) ? sanitize_text_field($new_instance['mcw_message']) : '';
        return $instance;
 	}

    // Display widget on front-end
    public function widget( $args, $instance ) {

        $title = apply_filters('widget_title', $instance['mcw_title']);
        echo $args['before_widget'];
        echo $args['before_title'];
            echo '<h3>'.$title.'</h3>';
        echo $args['after_title'];

        if($instance['mcw_display_type'] == 'static_message'){
             echo $instance['mcw_message'];  
        }
        else if($instance['mcw_display_type'] == 'recent_posts'){
               $query = new WP_Query(array(
                "posts_per_page"=>$instance['mcw_number_of_post'],
                "post_status"=>"publish",
                "order"=>"ASC"
               ));

            if( $query->have_posts() ) {
                while( $query->have_posts() ) {
                    $query->the_post();

                    echo '<li> <a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
                }
                wp_reset_postdata();
            }
            else{
                echo "No post found.....";
            }
        }


        echo $args['after_widget'];
  
 	}
}