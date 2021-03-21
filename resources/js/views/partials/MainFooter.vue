<template>
    <footer class="bg-very-dark">
        <div class="row p-20">
            <div class="col-lg-3">
                <img class="img-fluid" src="/images/logo/logo.png">
                <p>Minecraft survival at its best</p>
                <a class="text-white" href="mailto:staff@capecraft.net">staff@capecraft.net</a>
            </div>
            <div class="col text-right">
                <MainNavbarContent class="navbar-nav d-md-inline-flex d-none" />
            </div>
        </div>
        <div class="p-30 text-center" style="background: #0f0f0f;">
            <small class="text-light"><font-awesome-icon icon="copyright"/> {{new Date().getFullYear()}}. CapeCraft.net | All Rights Reserved. This website is not affiliated with Mojang</small>
        </div>
    </footer>
</template>

<script>
    import MainNavbarContent from './MainNavbarContent'

    export default {
        components: {
            MainNavbarContent
        }
    }
</script>