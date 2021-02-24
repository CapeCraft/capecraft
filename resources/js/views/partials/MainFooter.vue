<template>
    <footer class="bg-very-dark">
        <div class="row p-20">
            <div class="col-lg-3">
                <img class="img-fluid" src="/images/logo/logo.png">
                <p>Minecraft survival at its best</p>
                <a class="text-white" href="mailto:staff@capecraft.net">staff@capecraft.net</a>
            </div>
            <div class="col text-right">
                <ul class="navbar-nav d-inline-flex">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'home' }">Home</router-link>
                    </li>

                    <li class="nav-item dropdown">
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
            </div>
        </div>
        <div class="p-30 text-center" style="background: #0f0f0f;">
            <small class="text-light"><font-awesome-icon icon="copyright"/> {{new Date().getFullYear()}}. CapeCraft.net | All Rights Reserved. This website is not affiliated with Mojang</small>
        </div>
    </footer>
</template>