import { now } from 'lodash'
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
        modal: null
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
        },
        openModal(state, data) {
            if(data == 'close') {
                halfmoon.toggleModal('modal')
            } else {
                state.modal = { id: new Date(), data }
            }
        }
    },
    actions: {
        login({ commit }, data) {
            commit('setUserData', data)
        },
        logout({ commit }) {
            commit('clearUserData')
        },
        modal({ commit }, data) {
            commit('openModal', data)
        }
    },
    getters : {
        user: state => state.user,
        modal: state => state.modal
    }
})