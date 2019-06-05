<template>
  <nav class="navbar navbar-expand-lg navbar-dark primary-color" v-bind:class="homeMenu">
    <router-link class="navbar-brand" to="/">
      <img height="50" src="/assets/img/logo/logo.png">
    </router-link>
    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><router-link class="nav-link" to="/">Home</router-link></li>
        <li class="nav-item"><router-link class="nav-link" to="/blog">Blog</router-link></li>
        <li class="nav-item"><router-link class="nav-link" to="/rules">Rules</router-link></li>
        <li class="nav-item"><router-link class="nav-link" to="/staff">Staff</router-link></li>
        <li class="nav-item"><router-link class="nav-link" target="_blank" to="/merch">Merch</router-link></li>
        <li class="nav-item"><router-link class="nav-link" target="_blank" to="/donate">Donate</router-link></li>
        <li class="nav-item"><router-link class="nav-link" target="_blank" to="/discord">Discord</router-link></li>
      </ul>
    </div>
  </nav>
</template>

<script>
  export default {
    name: 'Menu',
    computed: {
      homeMenu: function () {
        return (this.$route.path === "/") ? 'home-menu' : null
      }
    }
  }
</script>

<style>
  .navbar {
    transition: .3s !important;
  }

  .home-menu {
    position: absolute !important;
    width: 100% !important;
    z-index: 1000 !important;
    background-color: rgba(0, 0, 0, 0.5) !important;
    box-shadow: 0px 20px 20px 0px rgba(0, 0, 0, 0.3) !important;
  }

  @media(max-width: 992px) {
    .home-menu {
      background-color: #151625 !important;
    }
  }
</style>
