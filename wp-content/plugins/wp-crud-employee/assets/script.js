jQuery(document).ready(function(){

    // Add form validation
    jQuery("#frm_add_employee").validate();

    // form submit
    jQuery("#frm_add_employee").on("submit", function(e)
    {   
        e.preventDefault();
        var formData = new FormData(this);

        jQuery.ajax({
            url:wce_object.ajax_url,
            method: "POST",
            data: formData,
            dataType:"json",
            processData:false,
            contentType:false,
            success:function(response){
                jQuery("#message").html(response).css("color", "green");
            }
            
        });
    });

}); 