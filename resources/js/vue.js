import Vue from 'vue';

// VueX
import Vuex from 'vuex';
import Store from '@/store'
Vue.use(Vuex);

//Router
import VueRouter from 'vue-router'
import Router from '@/router'
Vue.use(VueRouter);

// Font Awesome
import { FontAwesomeIcon, FontAwesomeLayers } from '@/fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('font-awesome-layers', FontAwesomeLayers);

// Common Filter
Vue.filter('formatDate', function(value) {
    if(/^\d+$/.test(value)) value = +value;
    let date = new Date(value);
    let formatDate = `${date.getFullYear()}-${('0' + (date.getMonth()+1)).slice(-2)}-${('0' + date.getDate()).slice(-2)}`;
    let formatTime = `${('0' + date.getHours()).slice(-2)}:${('0' + date.getMinutes()).slice(-2)}`
    return `${formatDate} ${formatTime}`
});

// Layout
import CapeCraft from '@/views/CapeCraft'

const app = new Vue({
    el: '#app',
    components: { 'capecraft-app': CapeCraft },
    store: Store,
    router: Router
})