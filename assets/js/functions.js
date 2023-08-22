jQuery( document ).ready(function($) {

    $(window).scroll(function(){
        $('.topnav').toggleClass('scrollednav py-0', $(this).scrollTop() > 50);
    });

    $('section.widget_block h5').addClass('font-weight-bold spanborder');
    $('section.widget_block h5').wrapInner('<span></span>');
    
});
