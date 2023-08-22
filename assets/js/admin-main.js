jQuery(document).ready(function ($){
    $('.gnulinux-options').on('click','.delete-main-post', function (){
        $('#main_post, #main_post_id').val('');
        $('#main_post_title').empty();
    });

    $('#main_post').autocomplete({
        source: ajaxurl + '?action=main_post_action&_wpnonce=' + gnulinuxObject.nonce,
        minLength: 2,
        delay: 500,
        select:function(event,ui){
            $('#main_post_id').val(ui.item.id);
            $('#main_post_title').html('<strong>' + gnulinuxObject.post_selected + '</strong> ' + ui.item.label + ' <button class="button delete-main-post"><span class="dashicons dashicons-trash"></span></button>');
        }
    });

    // on upload button click
    $('body').on( 'click', '.gnulinux-upl', function(e){

        e.preventDefault();

        var button = $(this),
            custom_uploader = wp.media({
                title: 'Insert image',
                library : {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type : 'image'
                },
                button: {
                    text: 'Use this image' // button label text
                },
                multiple: false
            }).on('select', function() { // it also has "open" and "close" events
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                button.html('<img src="' + attachment.url + '">').next().show().next().val(attachment.id);
            }).open();

    });

    // on remove button click
    $('body').on('click', '.gnulinux-rmv', function(e){

        e.preventDefault();

        var button = $(this);
        button.next().val(''); // emptying the hidden field
        button.hide().prev().html('Upload image');
    });

});