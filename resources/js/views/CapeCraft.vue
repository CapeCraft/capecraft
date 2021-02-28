<template>
    <main>
        <div class="page-wrapper">
            <div class="content-wrapper">
                <MainMenu v-if="!user || !this.$route.path.includes('/admin')"/>
                <AdminMenu v-else/>
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

<style lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .25s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .btn-discord {
        background-color: #7289da !important;
    }

    kbd {
        background: #191c20 !important;
        font-size: inherit !important;
        -webkit-user-select: all !important;
        -moz-user-select: all !important;
        -ms-user-select: all !important;
        user-select: all !important;
    }

    #content {
        background-image: url("/images/home-dark.jpg");
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
    import AdminMenu from './partials/admin/AdminMenu'
    import MainFooter from './partials/MainFooter'
    export default {
        watch: {
            $route: {
                handler: function(to) {
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
            AdminMenu,
            MainFooter,
        },
        computed: mapState(['user'])
    }
</script>