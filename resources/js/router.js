import Vue from 'vue'
import VueRouter from 'vue-router'
import {store} from './store/index'

Vue.use(VueRouter)

import Login from './components/Login'
import Register from './components/Register'
import Links from './components/Links'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/',
        name: 'links',
        component: Links
    }
];

let route = new VueRouter({
    routes
});

route.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})

export const router = route
