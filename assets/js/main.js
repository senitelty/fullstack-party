require('jquery');
require('bootstrap');

import PerfectScrollbar from 'perfect-scrollbar';
if ($('.scroll').length > 0) {
    let scroll = document.querySelector('.scroll');
    const ps = new PerfectScrollbar(scroll);
    console.log('inited!');
}