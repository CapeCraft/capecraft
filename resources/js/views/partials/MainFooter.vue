<template>
    <footer class="bg-very-dark">
        <div class="row p-20">
            <div class="col-lg-3">
                <img class="img-fluid" src="/images/logo/logo.png">
                <h1>CapeCraft.net</h1>
                <p>Minecraft survival at its best</p>
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
                <p>Copyright <font-awesome-icon :icon="[ 'far', 'copyright' ]"/> <a class="text-white" href="https://CapeCraft.net">https://CapeCraft.net</a> {{new Date().getFullYear()}}</p>
                <a class="text-white" href="mailto:staff@capecraft.net">staff@capecraft.net</a>
            </div>
        </div>
    </footer>
</template>