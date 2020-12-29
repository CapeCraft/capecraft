<template>
    <nav class="navbar bg-very-dark h-auto d-block d-md-flex">
        <router-link :to="{ name: 'home' }" style="width:15%">
            <img class="img-fluid" src="/images/logo/logo.png">
        </router-link>
        <ul class="navbar-nav h-auto flex-wrap">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'home' }">Home</router-link>
            </li>

            <li class="nav-item dropdown with-arrow">
                <a class="nav-link" data-toggle="dropdown">Rules<font-awesome-icon icon="angle-down" class="ml-5"/></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <router-link class="dropdown-item" :to="{ name: 'gallery' }">Game Rules</router-link>
                    <router-link class="dropdown-item" :to="{ name: 'gallery-cape-editor' }">AFK Rules</router-link>
                    <router-link class="dropdown-item" :to="{ name: 'gallery-cape-editor' }">Alt Rules</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link class="dropdown-item" :to="{ name: 'gallery-minecon-capes' }">Unban Requests</router-link>
                </div>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'staff' }">Staff</router-link>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/donate">Donate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/discord">Discord</a>
            </li>

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

    export default {
        computed: mapState(['user'])
    }
</script>