jQuery(document).ready(function(){
     jQuery('#frm-csv-upload').on("submit", function(event){
        event.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        jQuery.ajax({
            url:cdu_object.ajax_url,
            method:"POST",
            data:formData,
            dataType:"json",
            processData:false,
            contentType:false,
            success:function(response){
                if(response.status){
                     jQuery("#message").text(response.message).css("color","green");
                 }
                 jQuery("#frm-csv-upload")[0].reset();
            },
            error: function(error) {
                console.error("AJAX Error:", error); // Improved error handling
            }

        });
    });
    
});