require("./bootstrap");

// SkinView3D
import SkinView3D from './skinview3d.bundle'

// VueJS
require("./vue")

// Halfmoon
const halfmoon = require('halfmoon');
window.halfmoon = halfmoon;
document.addEventListener('DOMContentLoaded', function () {
    halfmoon.onDOMContentLoaded();
})