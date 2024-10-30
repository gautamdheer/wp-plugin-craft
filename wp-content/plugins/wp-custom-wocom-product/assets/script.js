jQuery(document).ready(function ($) {

    jQuery("#wcp_upload_image_button").click(function (e) {
        e.preventDefault();
        var fileInfo = wp.media({
            title: "Select Product Image",
            button: {
                text: "Use this image"
            },
            multiple: false
        }).open().on("select", function () {
            var attachment = fileInfo.state().get("selection").first().toJSON();
            jQuery("#wcp_product_image").attr("src", attachment.url);
            jQuery("#product_media_id").val(attachment.id);
            console.log(attachment.id);
        });
    });

});
