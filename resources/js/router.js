import VueRouter from 'vue-router'

//Pages
import HomePage from './views/pages/HomePage'

import StaffPage from './views/pages/StaffPage'

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
        path: '/staff',
        name: 'staff',
        meta: {
            title: 'Staff'
        },
        component: StaffPage
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
        next('/account/login')
        return
    }
    next()
})

export default router;