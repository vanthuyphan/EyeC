jQuery(function ($) {
    var default_position = $(window).scrollTop();
    var last_position = 0;
    $(window).scroll(function () {
        var current_position = $(window).scrollTop();
        $(document.body).triggerHandler("windowScrolling", [current_position, last_position, default_position]);
        last_position = current_position;
    });
});