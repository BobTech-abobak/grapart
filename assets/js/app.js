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

// Add images
require('./images.js');