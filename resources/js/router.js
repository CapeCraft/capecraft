import VueRouter from 'vue-router'

//Pages
import HomePage from './views/pages/HomePage'
import UnbanPage from './views/pages/UnbanPage'
import StaffPage from './views/pages/StaffPage'

import AdminPage from './views/pages/admin/AdminPage'
import AdminAccountPage from './views/pages/admin/AdminAccountPage'
import AdminBanListPage from './views/pages/admin/bans/AdminBanListPage'
import AdminBanPage from './views/pages/admin/bans/AdminBanPage'
import AdminPlayerPage from './views/pages/admin/bans/AdminPlayerPage'
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