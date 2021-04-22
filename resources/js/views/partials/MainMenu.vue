<template>
    <nav class="navbar bg-very-dark h-auto d-block d-md-flex">
        <router-link to="/" style="width:15%" class="d-none d-md-block">
            <img class="img-fluid" src="/images/logo/logo.png">
        </router-link>
        <MainNavbarContent class="navbar-nav h-auto flex-wrap"/>
        <ul class="navbar-nav h-auto flex-wrap ml-auto" v-if="user">
            <router-link class="nav-link" to="/admin"><font-awesome-icon icon="tachometer-alt" class="mr-10"/>Admin</router-link>
        </ul>
    </nav>
</template>

<style lang="scss" scoped>
    img {
        margin-bottom: -1rem;
    }

    @media(max-width: 992px) {
        .navbar {
            position: relative !important;
        }
    }

    .navbar {
        z-index: 100 !important;
    }

    .navbar-nav {
        min-height: 5rem;
    }

    .nav-link {
        color: #f7f7f7 !important;
        &:hover {
            color: #d8d8d8 !important;
        }
    }
</style>

<script>
    import { mapState } from 'vuex'
    import MainNavbarContent from '@/views/partials/MainNavbarContent'

    export default {
        computed: mapState(['user']),
        components: {
            MainNavbarContent
        }
    }
</script>