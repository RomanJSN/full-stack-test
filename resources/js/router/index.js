import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../pages/login'
import Register from '../pages/register'
import Index from '../pages/index'
import authenticate from '../middleware/authenticate'
import redirectIfAuthenticated from '../middleware/redirectIfAuthenticated'
import callback from '../middleware/callback';

Vue.use(VueRouter)


const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            layout: 'auth',
            requiresLogin: false
        }
    },
    {
        path: '/register',
        component: Register,
        meta: {
            layout: 'auth',
            requiresLogin: false
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
    {
        path: '/callback',
        meta: {
            layout: 'auth',
        },
        beforeEnter: callback
    }
]

const router = new VueRouter({ routes })

router.beforeEach(redirectIfAuthenticated)
router.beforeEach(authenticate)

export default router
