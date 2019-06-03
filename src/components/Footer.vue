<template>
  <footer class="container-fluid">
    <div class="row no-gutters">
      <div class="col-lg-3">
        <img class="img-fluid" src="/assets/img/logo/logo.png">
        <h1>CapeCraft.net</h1>
        <p>Minecraft survival at its best</p>
      </div>
      <div class="col text-right">
        <ul class="nav justify-content-end">
          <li class="nav-item"><a class="nav-link text-white" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="/blog">Blog</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="/rules">Rules</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="/staff">Staff</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="/unban">Unban</a></li>
          <li class="nav-item"><a class="nav-link text-white" target="_blank" href="/donate">Donate</a></li>
          <li class="nav-item"><a class="nav-link text-white" target="_blank" href="/discord"><i class="fab fa-discord"></i> Discord</a></li>
          <li class="nav-item"><a class="nav-link text-white" target="_blank" href="/youtube"><i class="fab fa-youtube"></i> YouTube</a></li>
          <li class="nav-item"><a class="nav-link text-white" target="_blank" href="/youtube"><i class="fas fa-video"></i> Livestream</a></li>
        </ul>
        <p>Copyright <i class="far fa-copyright"></i> <a class="text-white" href="https://CapeCraft.net">https://CapeCraft.net</a>
          {{new Date().getFullYear()}}
        </p>
        <a class="text-white" href="mailto:staff@capecraft.net">staff@capecraft.net</a>
      </div>
    </div>
  </footer>
</template>

<script>
  export default {
    name: 'Footer'
  }
</script>
