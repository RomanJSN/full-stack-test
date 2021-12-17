import store from '../store'

export default async (to, from, next) => {
    const isUser = store.state.auth.user
    const requiresLogin = to.matched.some(record => record.meta.requiresLogin)

    if (!isUser) {
        await store.dispatch('auth/getUserData')
    }

    if (requiresLogin && !isUser) {
        next({ name: 'Login' })
    } else {
        next()
    }
}
