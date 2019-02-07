require('../css/ekko-lightbox.css');
require('./ekko-lightbox.min.js');
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        alwaysShowClose: true
    });
});