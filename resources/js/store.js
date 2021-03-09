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
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },
        clearUserData() {
            localStorage.removeItem('user')
            location.reload()
        },
        updateUser(state, data) {
            let userData = JSON.parse(localStorage.getItem('user'));
            userData.user = data;
            state.user = userData.user;
            localStorage.setItem('user', JSON.stringify(userData))
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
        updateUser({ commit }) {
            return axios.get('/api/admin/user').then((response) => {
                commit('updateUser', response.data);
            })
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