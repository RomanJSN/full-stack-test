import axios from 'axios'
import { ERROR } from '../constants/message'
import { notify } from '../helpers/vuex-helpers'

export default {
    namespaced: true,
    state: () => ({
        categories: [],
    }),
    getters: {
        getCategories(state) {
            return state.categories
        },
    },
    mutations: {
        updateCategories(state, categories) {
            state.categories = categories
        }
    },
    actions: {
        async findCategories({ commit }) {
            try {
                const { data } = await axios.get('api/categories')
                commit('updateCategories', data)
            } catch (e) {
                notify(commit, ERROR)
            }
        }
    }
}
