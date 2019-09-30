// Add global scss file
require('../css/global.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

// Add font-awesome
require('@fortawesome/fontawesome-free/js/all.js');

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('../css/banner.css');
require('../css/contact.css');
require('../css/content.css');
require('../css/footer.css');
require('../css/header.css');
require('../css/menu.css');

$(document).ready(function(){
    // Menu animation
    $(".menu-icon").on("click", function() {
        $(".menu-mobile").css('width', '80%');
    });
    $(".menu-mobile").on("click", function() {
        $(".menu-mobile").css('width', '0px');
    });

    $("form[name=\"contact_form\"]").submit(function( event ) {
        var email = $(this).find("input[id$=\"email\"]");
        var phone = $(this).find("input[id$=\"phone\"]");
        if (email.val() == '' && phone.val() == '') {
            $("#emailHelp").addClass("text-notvalidated").removeClass("text-muted");
            setTimeout(function () {
                $("#emailHelp").removeClass("text-notvalidated").addClass("text-muted");
            }, 3000)
            event.preventDefault();
        } else {
            $(this).submit();
        }
    });
});