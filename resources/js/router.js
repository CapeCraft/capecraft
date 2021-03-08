import VueRouter from 'vue-router'

//Pages
import HomePage from './views/pages/HomePage'
import GameRulesPage from './views/pages/GameRulesPage'
import AfkRulesPage from './views/pages/AfkRulesPage'
import AltRulesPage from './views/pages/AltRulesPage'
import UnbanPage from './views/pages/UnbanPage'
import StaffPage from './views/pages/StaffPage'

import AdminPage from './views/pages/admin/AdminPage'
import AdminAccountPage from './views/pages/admin/AdminAccountPage'
import AdminBanListPage from './views/pages/admin/bans/AdminBanListPage'
import AdminBanPage from './views/pages/admin/bans/AdminBanPage'
import AdminPlayerPage from './views/pages/admin/bans/AdminPlayerPage'
import AdminRulesPage from './views/pages/admin/AdminRulesPage'
import AdminStaffPage from './views/pages/admin/AdminStaffPage'
import AdminLoginPage from './views/pages/admin/AdminLoginPage'

import NotFoundPage from './views/errors/NotFoundPage'

const routes = [
    {
        path: '/',
        name: 'home',
        meta: {
            title: 'Home'
        },
        component: HomePage
    },
    {
        path: '/rules',
        name: 'game-rules',
        meta: {
            title: 'Game Rules'
        },
        component: GameRulesPage
    },
    {
        path: '/rules/afk',
        name: 'afk-rules',
        meta: {
            title: 'AFK Rules'
        },
        component: AfkRulesPage
    },
    {
        path: '/rules/alt',
        name: 'alt-rules',
        meta: {
            title: 'Alt Rules'
        },
        component: AltRulesPage
    },
    {
        path: '/unban',
        name: 'unban',
        meta: {
            title: 'Unban Request'
        },
        component: UnbanPage
    },
    {
        path: '/staff',
        name: 'staff',
        meta: {
            title: 'Staff'
        },
        component: StaffPage
    },
    {
        path: '/admin',
        name: 'admin',
        meta: {
            title: 'Admin',
            auth: true
        },
        component: AdminPage
    },
    {
        path: '/admin/account',
        name: 'My Profile',
        meta: {
            title: 'Admin',
            auth: true
        },
        component: AdminAccountPage
    },
    {
        path: '/admin/bans/:page?',
        name: 'admin-ban-list',
        meta: {
            title: 'Admin Bans',
            auth: true
        },
        component: AdminBanListPage
    },
    {
        path: '/admin/ban/:id?',
        name: 'admin-ban',
        meta: {
            title: 'Admin Bans',
            auth: true
        },
        component: AdminBanPage
    },
    {
        path: '/admin/player/:uuid?',
        name: 'admin-player',
        meta: {
            title: 'Admin Bans',
            auth: true
        },
        component: AdminPlayerPage
    },
    {
        path: '/admin/rules',
        name: 'admin-rules',
        meta: {
            title: 'Admin Rules',
            auth: true
        },
        component: AdminRulesPage
    },
    {
        path: '/admin/staff',
        name: 'admin-staff',
        meta: {
            title: 'Admin Staff',
            auth: true
        },
        component: AdminStaffPage
    },
    {
        path: '/admin/login',
        name: 'admin-login',
        meta: {
            title: 'Login'
        },
        component: AdminLoginPage
    },
    {
        path: '*',
        name: 'not-found',
        meta: {
            title: 'Page not found'
        },
        component: NotFoundPage
    }
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/admin/login')
        return
    }
    next()
})

export default router;