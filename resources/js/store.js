import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null
    },
    mutations: {
        setUserData(state, userData) {
            state.user = userData.user
            sessionStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },
        clearUserData() {
            sessionStorage.removeItem('user')
            location.reload()
        }
    },
    actions: {
        login({ commit }, data) {
            commit('setUserData', data)
        },
        logout({ commit }) {
            commit('clearUserData')
        },
    },
    getters : {
        user: state => state.user,
    }
})