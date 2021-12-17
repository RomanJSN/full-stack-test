import axios from 'axios'

export default {
    namespaced: true,
    state: () => ({
        user: null,
    }),
    getters: {
        getUser(state) {
            return state.user
        }
    },
    mutations: {
        updateUser(state, user) {
            state.user = user
        }
    },
    actions: {
        async getUserData({ commit }) {
            const jwt = localStorage.getItem('Authorization')

            if (!jwt) return

            try {
                const { data } = await axios.post('http://localhost:8000/api/auth/me', {}, {
                    headers: {
                        'Authorization': jwt
                    }
                })
                commit('updateUser', data)
            } catch (e) {
                // console.log(e)
            }
        },
        async loginUser({ dispatch }, credentials) {
            try {
                const { data } = await axios.post(
                    'http://localhost:8000/api/auth/login',
                    credentials
                )
                localStorage.setItem('Authorization', `Bearer ${data.access_token}`)
            } catch (e) {
                // console.log(e)
            }
        },
        async logoutUser({ commit }) {
            const jwt = localStorage.getItem('Authorization')
            try {
                await axios.post('http://localhost:8000/api/auth/logout', {}, {
                    headers: {
                        'Authorization': jwt
                    }
                })
                localStorage.removeItem('Authorization')
                commit('updateUser', null)
            } catch (e) {
                // console.log(e)
            }
        },
        async registerUser({ state }, userData) {
            try {
                await axios.post('http://localhost:8000/api/auth/register', userData)
            } catch (e) {
                // console.log(e)
            }
        }
    }
}
