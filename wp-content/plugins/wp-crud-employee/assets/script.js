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
            processData:false,
            contentType:false,
            success: function(response) {
                if(response.status) {
                    jQuery("#message").html('<p style="color: green;">' + response.message + '</p>');
                    jQuery("#frm_add_employee")[0].reset();
                } else {
                    jQuery("#message").html('<p style="color: red;">' + response.message + '</p>');
                }
               
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ', ' + errorThrown);
            }
            
        });
    });

}); 