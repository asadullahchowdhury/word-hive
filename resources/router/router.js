import {createRouter, createWebHistory} from "vue-router";
import Layout from "../js/front-panel/layout/layout.vue";
import AdminLayout from "../js/admin-panel/layout/layout.vue";
import Home from "../js/front-panel/pages/home/home.vue";
import Dashboard from "../js/admin-panel/pages/dashboard/dashboard.vue";
import Login from "../js/admin-panel/pages/authentication/login.vue";
import Forgot from "../js/admin-panel/pages/authentication/forgot.vue";
import Reset from "../js/admin-panel/pages/authentication/reset.vue";
import Blogs from "../js/admin-panel/pages/blogs/blogs.vue";

const admin_root = "/admin";

const routes = [
    // Front panel
    {
        path: '/',
        component: Layout,
        children: [
            {path: '', name: 'home', component: Home},
        ],
    },

    // Admin Authentication
    {
        path: admin_root + '/login',
        name: 'admin.login',
        component: Login,
        meta: {guestOnly: true}
    },
    {
        path: admin_root + '/forgot-password',
        name: 'admin.forgot-password',
        component: Forgot,
        meta: {guestOnly: true}
    },
    {
        path: admin_root + '/reset-password',
        name: 'admin.reset-password',
        component: Reset,
        meta: {guestOnly: true}
    },

    // Admin panel (protected)
    {
        path: admin_root,
        component: AdminLayout,
        meta: {requiresAuth: true},
        children: [
            {path: '', name: 'admin.dashboard', component: Dashboard},
            {path: 'blogs', name: 'admin.blogs', component: Blogs},
            // more admin routes here
        ]
    },

    // Fallback
    {path: '/:pathMatch(.*)*', redirect: '/'}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {el: to.hash, behavior: 'smooth'};
        } else {
            return {top: 0, behavior: 'smooth'};
        }
    }
});

// Navigation Guard: Protect admin routes
router.beforeEach(async (to, from, next) => {
    const token = localStorage.getItem('admin_token');


    if (to.meta.requiresAuth && !token) {
        // Redirect to log in if not authenticated
        return next({name: 'admin.login'});
    }

    if (to.meta.guestOnly && token) {
        // Prevent access to login page if already authenticated
        return next({name: 'admin.dashboard'});
    }

    next();
});

export default router;
