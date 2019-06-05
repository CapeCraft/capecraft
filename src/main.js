import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'

import routes from './routes'

Vue.use(VueRouter)

Vue.prototype.$devMode = true

const router = new VueRouter({routes})

new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
