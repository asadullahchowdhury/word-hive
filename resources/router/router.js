import { createRouter, createWebHistory } from "vue-router";
import Layout from "../js/front-panel/layout/layout.vue";
import AdminLayout from "../js/admin-panel/layout/layout.vue";
import Home from "../js/front-panel/pages/home/home.vue";
import Dashboard from "../js/admin-panel/pages/dashboard/dashboard.vue";
import Login from "../js/admin-panel/pages/authentication/login.vue";

const admin_root = "/admin";

const routes = [
    // Front panel
    {
        path: '/',
        component: Layout,
        children: [
            { path: '', name: 'home', component: Home },
        ],
    },

    // Admin login
    {
        path: admin_root + '/login',
        name: 'admin.login',
        component: Login,
    },

    // Admin panel
    {
        path: admin_root,
        component: AdminLayout,
        requiresAuth: true,
        children: [
            { path: 'dashboard', name: 'admin.dashboard', component: Dashboard },
            // Add more admin routes here
        ]
    },

    // Fallback
    { path: '/:pathMatch(.*)*', redirect: '/' }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return { el: to.hash, behavior: 'smooth' };
        } else {
            return { top: 0, behavior: 'smooth' };
        }
    }
});

export default router;
