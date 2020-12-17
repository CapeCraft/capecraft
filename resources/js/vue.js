import Vue from 'vue';

// VueX
import Vuex from 'vuex';
import Store from './store'
Vue.use(Vuex);

//Router
import VueRouter from 'vue-router'
import Router from './router'
Vue.use(VueRouter);

// Font Awesome
import { FontAwesomeIcon, FontAwesomeLayers } from './fontawesome'
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('font-awesome-layers', FontAwesomeLayers);

/**
 * Common Components
 */

// Player Model
import PlayerModel from './views/partials/PlayerModel';
Vue.component('player-model', PlayerModel);

// Layout
import CapeCraft from './views/CapeCraft'

const app = new Vue({
    el: '#app',
    components: { 'capecraft-app': CapeCraft },
    store: Store,
    router: Router
})