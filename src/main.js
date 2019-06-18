import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import routes from './routes'

import 'arrive'

const router = new VueRouter({routes})

Vue.use(VueRouter)

Vue.prototype.$devMode = true
Vue.prototype.$hostAPI = (Vue.prototype.$devMode) ? "http://192.168.193.51" : "https://capecraft.net";

new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
