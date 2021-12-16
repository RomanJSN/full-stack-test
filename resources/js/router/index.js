import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../pages/login'
import Register from '../pages/register'
import Index from '../pages/index'
import store from "../store";

Vue.use(VueRouter)


const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            layout: 'auth'
        }
    },
    {
        path: '/register',
        component: Register,
        meta: {
            layout: 'auth'
        }
    },
    {
        path: '/',
        name: 'Home',
        component: Index,
        meta: {
            requiresLogin: true
        }
    },
]

const router = new VueRouter({ routes })

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresLogin) && !store.state.auth.user) {
        next({ name: 'Login' })
    } else {
        next()
    }
})

export default router
