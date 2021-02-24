import VueRouter from 'vue-router'

//Pages
import HomePage from './views/pages/HomePage'
import UnbanPage from './views/pages/UnbanPage'
import StaffPage from './views/pages/StaffPage'

import AdminPage from './views/pages/admin/AdminPage'
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
    const loggedIn = sessionStorage.getItem('user')
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/admin/login')
        return
    }
    next()
})

export default router;