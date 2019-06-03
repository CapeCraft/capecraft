<template>
  <div id="app">
    <Menu/>
    <routerView/>
    <Footer/>    
  </div>
</template>

<script>
import Menu from './components/Menu.vue'
import Footer from './components/Footer.vue'

export default {
  name: 'app',
  components: {
    Menu,
    Footer
  }
}
</script>

<style>
body {
  background: url("/assets/img/home.jpg");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  font-family: 'Roboto', sans-serif !important;
}

footer {
  color: white;
  padding: 2vh 2vw;
  padding-bottom: 0;
  background: #1b1b1b;
}

/* CONTENT */
.div-mid {
  top: 45%;
  transform: translateY(-50%);
  position: relative;
}

.content {
  width: 80%;
  min-height: 65vh;
  margin: 4vh auto;
  padding: 5vh 2vw;
  background: #f7f7f7;
  box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.5);
}

@media(max-width: 992px) {
  .content {
    padding: 5vh 5vw;
  }
}

/* NAVBAR */
nav {
  background-color: #0275d8 !important;
}

.nav-item {
  padding: 0 1vw;
  position: relative;
}

/* BLOG */
.blogpage {
  width: 80%;
  margin: 0 auto;
}

.blogpost {
  margin: 4vh auto;
  padding: 5vh 2vw;
  background: #f7f7f7;
  box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.5);
}

/* Text */
.text-discord {
  color: #7289da;
}

.btn-discord {
    color: #fff;
    background-color: #7289da
}

.btn-discord:hover,.btn-discord:focus,.btn-discord:active,.btn-discord:active:focus {
    color: #fff;
    background-color: #667bc4
}
</style>
