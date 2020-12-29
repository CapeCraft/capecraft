<template>
    <main>
        <div class="page-wrapper">
            <div class="content-wrapper">
                <MainMenu/>
                <div id="content" class="container-fluid">
                    <transition name="fade" mode="out-in">
                        <router-view/>
                    </transition>
                </div>
                <MainFooter/>
            </div>
        </div>
    </main>
</template>

<style>
    #content {
        background-image: url("/images/home.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
    section, #header {
        min-height: 90vh;
    }
</style>

<script>
    import { mapState } from 'vuex'
    import MainMenu from './partials/MainMenu'
    import MainFooter from './partials/MainFooter'
    export default {
        watch: {
            $route: {
                handler: function(to, from) {
                    document.title = to.meta.title + ' | CapeCraft.Net'
                    if(this.user && this.user.notification) {
                        this.showNotification = true;
                    }
                },
                immediate: true
            }
        },
        created() {
            const userInfo = sessionStorage.getItem('user')
            if (userInfo) {
                const userData = JSON.parse(userInfo)
                this.$store.commit('setUserData', userData)
            }
            axios.interceptors.response.use(response => response, error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            });
        },
        components: {
            MainMenu,
            MainFooter,
        },
        computed: mapState(['user'])
    }
</script>