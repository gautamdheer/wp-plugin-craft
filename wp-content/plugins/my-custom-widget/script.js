jQuery(document).ready(function(){
    
    jQuery(document).on("change", ".mcw_dd_option", function() {
        let mcw_option_value = jQuery(this).val();

        if(mcw_option_value == "recent_posts"){
            jQuery("p#mcw_display_recent_post").removeClass("hide-element");
            jQuery("p#mcw_static_message").addClass("hide-element");
        }
        else if(mcw_option_value == "static_message") {
            jQuery("p#mcw_display_recent_post").addClass("hide-element");
            jQuery("p#mcw_static_message").removeClass("hide-element");
        }
      
    });

});