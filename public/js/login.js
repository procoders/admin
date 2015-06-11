var handleLoginPageChangeBackground = function() {
    $('[data-click="change-bg"]').live('click', function() {
        var targetImage = '[data-id="login-cover-image"]';
        var targetImageSrc = $(this).find('img').attr('src');

        $('.login-cover-image').css({
            'background' : 'url(\'' + targetImageSrc + '\') no-repeat',
            'background-size': 'cover',
            'transition': 'background .35s ease-in-out'
        });
        $('[data-click="change-bg"]').closest('li').removeClass('active');
        $(this).closest('li').addClass('active');
    });
};

var LoginV2 = function () {
    "use strict";
    return {
        //main function
        init: function () {
            handleLoginPageChangeBackground();
        }
    };
}();