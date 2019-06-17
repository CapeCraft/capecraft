nb<template>
  <main class="text-white">
    <div class="div-mid text-center">
      <img class="homelogo" src="/assets/img/logo/logo.png"/>
      <h3>Come and PLACEHOLDER on <kbd class="pl-3">Play.CapeCraft.Net <i class="fa fa-copy" data-clipboard-text="Play.CapeCraft.Net"></i></kbd></h3>
      <a class="btn btn-discord btn-raised" target="_blank" href="/discord"><i class="fab fa-discord"></i> Join our Discord</a>
    </div>
  </main>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'Home',
    data() {
      return {
        loading: true,
        staff: []
      }
    },
    created() {
      let host = (this.$devMode) ? "http://192.168.129.3" : "https://capecraft.net";
      axios.get(host + '/admin/api/server').then(response => {
        this.staff = response.data;
        this.loading = false;
      })
    }
  }
</script>

<style>
main {
  height: 100vh;
}

.homelogo {
  width: 40%;
  margin-bottom: -3vh;
}

@media(max-width: 992px) {
  .homelogo {
      width: 80%;
      margin-bottom: -2vh;
  }
}
</style>
