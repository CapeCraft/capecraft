import VueRouter from 'vue-router'

//Pages
import HomePage from '@/views/pages/HomePage'
import AnnouncementsPage from '@/views/pages/AnnouncementsPage'
import GameRulesPage from '@/views/pages/GameRulesPage'
import AfkRulesPage from '@/views/pages/AfkRulesPage'
import AltRulesPage from '@/views/pages/AltRulesPage'
import UnbanPage from '@/views/pages/UnbanPage'
import RanksPage from '@/views/pages/RanksPage'
import StaffPage from '@/views/pages/StaffPage'

import AdminPage from '@/views/pages/admin/AdminPage'

import AdminAccountPage from '@/views/pages/admin/AdminAccountPage'
import AdminBanListPage from '@/views/pages/admin/bans/AdminBanListPage'
import AdminBanPage from '@/views/pages/admin/bans/AdminBanPage'

import AdminPlayerPage from '@/views/pages/admin/AdminPlayerPage'

import AdminAnnouncementsPage from '@/views/pages/admin/announcements/AdminAnnouncementsPage'
import AdminNewAnnouncementPage from '@/views/pages/admin/announcements/AdminNewAnnouncementPage'
import AdminEditAnnouncementPage from '@/views/pages/admin/announcements/AdminEditAnnouncementPage'
import AdminDeleteAnnouncementPage from '@/views/pages/admin/announcements/AdminDeleteAnnouncementPage'

import AdminRulesPage from '@/views/pages/admin/AdminRulesPage'
import AdminRanksPage from '@/views/pages/admin/AdminRanksPage'
import AdminStaffPage from '@/views/pages/admin/AdminStaffPage'
import AdminLoginPage from '@/views/pages/admin/AdminLoginPage'

import NotFoundPage from '@/views/errors/NotFoundPage'

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
        path: '/announcements/:page?',
        name: 'announcements-page',
        meta: {
            title: 'Announcements'
        },
        component: AnnouncementsPage
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
        path: '/ranks',
        name: 'ranks',
        meta: {
            title: 'Ranks'
        },
        component: RanksPage
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
        name: 'my-profile',
        meta: {
            title: 'My Profile',
            auth: true
        },
        component: AdminAccountPage
    },
    {
        path: '/admin/announcements/new',
        name: 'new-announcements',
        meta: {
            title: 'New Announcement',
            auth: true
        },
        component: AdminNewAnnouncementPage
    },
    {
        path: '/admin/announcements/:id/edit',
        name: 'edit-announcement',
        meta: {
            title: 'Admin Announcements',
            auth: true
        },
        component: AdminEditAnnouncementPage
    },
    {
        path: '/admin/announcements/:id/delete',
        name: 'delere-announcement',
        meta: {
            title: 'Admin Announcements',
            auth: true
        },
        component: AdminDeleteAnnouncementPage
    },
    {
        path: '/admin/announcements/:page?',
        name: 'admin-nnouncements',
        meta: {
            title: 'Admin Announcements',
            auth: true
        },
        component: AdminAnnouncementsPage
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
        path: '/admin/ranks',
        name: 'admin-ranks',
        meta: {
            title: 'Admin Ranks',
            auth: true
        },
        component: AdminRanksPage
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