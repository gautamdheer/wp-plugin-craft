<?php
    $post_id = isset($post->ID) ? $post->ID : "";
    $title = get_post_meta($post_id,"pmeta_title", true);
    $description = get_post_meta($post_id, "pmeta_description",true);

    wp_nonce_field("mmp_save_meta_data", "mmp_save_nonce_data");
?>

<p>
    <label for="pmeta_title">Meta Title</label>
    <input type="text" name="pmeta_title" id="pmeta_title" placeholder="Meta Title...." value="<?php echo $title; ?>">
</p>
<p>
    <label for="pmeta_description">Meta Description</label>
    <input type="text" name="pmeta_description" id="pmeta_description" placeholder="Meta Description...." value="<?php echo $description; ?>">
</p>

