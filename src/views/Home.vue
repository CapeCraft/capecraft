<template>
  <main class="text-white">
    <div class="div-mid text-center">
      <img class="homelogo" src="/assets/img/logo/logo.png"/>
      <h3>Come and PLACEHOLDER on <kbd class="pl-3">Play.CapeCraft.Net <i class="fa fa-copy" data-clipboard-text="Play.CapeCraft.Net"></i></kbd></h3>
      <a class="btn btn-discord btn-raised" target="_blank" href="/discord"><i class="fab fa-discord"></i> Join our Discord</a>
    </div>
  </main>
</template>

<script>
  export default {
    name: 'Home'
  }
</script>

<style>
main {
  height: 100vh;
}

.nav-item {
  padding: 0 1vw
}

body > .nav, body > .primary-color {
  position: absolute;
  width: 100%;
  z-index: 1000;
  background-color: rgba(0, 0, 0, 0.5) !important;
  box-shadow: 0px 20px 20px 0px rgba(0, 0, 0, 0.3);
  transition: .3s;
}

@media(max-width: 992px) {
  body > .nav, body > .primary-color {
    background-color: #151625 !important;
  }
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
