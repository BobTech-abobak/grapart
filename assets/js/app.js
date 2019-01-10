// Add global scss file
require('../css/global.scss');

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('../css/banner.css');
require('../css/contact.css');
require('../css/content.css');
require('../css/footer.css');
require('../css/header.css');
require('../css/menu.css');

// Add images
require('./images.js');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('bootstrap');

$(document).ready(function(){
    mainBannerAnimation();
});

function mainBannerAnimation()
{
    setTimeout(
        function () {
            $(".main-banner-1").fadeIn();
        }, 2000
    );
    setTimeout(
        function () {
            $(".main-banner-2").fadeIn();
        }, 4000
    );
    setTimeout(
        function () {
            $(".main-banner-3").slideDown();
        }, 6000
    );
}