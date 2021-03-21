<template>
    <ul>
        <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/announcements">Announcements</router-link>
        </li>

        <li class="nav-item dropdown with-arrow">
            <a class="nav-link" data-toggle="dropdown">Rules<font-awesome-icon icon="angle-down" class="ml-5"/></a>
            <div class="dropdown-menu dropdown-menu-right">
                <router-link class="dropdown-item" to="/rules">Game Rules</router-link>
                <router-link class="dropdown-item" to="/rules/afk">AFK Rules</router-link>
                <router-link class="dropdown-item" to="/rules/alt">Alt Rules</router-link>
                <div class="dropdown-divider"></div>
                <router-link class="dropdown-item" to="/unban">Unban Requests</router-link>
            </div>
        </li>

        <li class="nav-item">
            <router-link class="nav-link" to="/ranks">Ranks</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/staff">Staff</router-link>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="/donate">Donate</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="/discord">Discord</a>
        </li>
    </ul>
</template>