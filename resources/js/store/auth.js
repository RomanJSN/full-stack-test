import axios from 'axios'

export default {
    namespaced: true,
    state: () => ({
        user: null,
    }),
    getters: {},
    mutations: {
        updateUser(state, user) {
            state.user = user
        }
    },
    actions: {
        async getUserData({ commit }) {
            try {
                const { data } = await axios.post('http://localhost:8000/api/auth/me', {}, {
                    headers: {
                        'Authorization': localStorage.getItem('Authorization')
                    }
                })
                commit('updateUser', data)
            } catch (e) {
                console.log(e)
            }
        },
        async loginUser({ dispatch }, credentials) {
            try {
                const { data } = await axios.post(
                    'http://localhost:8000/api/auth/login',
                    credentials
                )
                localStorage.setItem('Authorization', `Bearer ${data.access_token}`)
                dispatch('getUserData')
            } catch (e) {
                console.log(e)
            }
        }
    }
}
