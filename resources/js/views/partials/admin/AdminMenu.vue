<template>
    <nav class="navbar bg-very-dark h-auto d-block d-md-flex">
        <router-link :to="{ name: 'home' }" style="width:15%">
            <img class="img-fluid" src="/images/logo/logo.png">
        </router-link>
        <ul class="navbar-nav h-auto flex-wrap">
            <li class="nav-item">
                <router-link class="nav-link" to="/admin">Home</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/admin/bans">Bans</router-link>
            </li>
            <li class="nav-item" v-if="user.group <= 2">
                <router-link class="nav-link" to="/admin/staff">Staff</router-link>
            </li>
            <li class="nav-item" v-if="user.group <= 2">
                <router-link class="nav-link" to="/admin/rules">Rules</router-link>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto h-auto flex-wrap" style="min-width:15rem">
            <li class="nav-item dropdown with-arrow">
				<a class="nav-link" data-toggle="dropdown"><img :src="`https://minecraftapi.net/api/v1/profile/${user.uuid}/avatar?size=24&overlay=true`" class="mr-10"> {{user.username}}<font-awesome-icon icon="angle-down" class="ml-5"/></a>
				<div class="dropdown-menu dropdown-menu-right">
                    <router-link class="dropdown-item" to="/admin/account">My Profile</router-link>
					<a href="" class="dropdown-item" @click="$store.dispatch('logout')">Log out</a>
				</div>
			</li>
        </ul>
    </nav>
</template>

<style lang="scss" scoped>
    .img-fluid {
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