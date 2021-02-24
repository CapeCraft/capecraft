require("./bootstrap");

// VueJS
require("./vue")

// Halfmoon
const halfmoon = require('halfmoon');
window.halfmoon = halfmoon;
document.addEventListener('DOMContentLoaded', function () {
    halfmoon.onDOMContentLoaded();
})