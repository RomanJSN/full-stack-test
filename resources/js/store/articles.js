import axios from 'axios'
import { ERROR, SUCCESS} from "../constants/message"
import { notify } from '../helpers/vuex-helpers'

export default {
    namespaced: true,
    state: () => ({
        articles: [],
        isLoading: false
    }),
    getters: {
        getArticles(state) {
            return state.articles
        },
        getIsLoading(state) {
            return state.isLoading
        }
    },
    mutations: {
        updateArticles(state, articles) {
            state.articles = articles
        },
        updateIsLoading(state, payload) {
            state.isLoading = payload
        }
    },
    actions: {
        async findArticles({ state, commit }, params = {}) {
            commit('updateIsLoading', true)
            try {
                const { data } = await axios.get('api/articles', {
                    params
                })
                commit('updateArticles', data)
            } catch (e) {
                notify(commit, ERROR)
            }
            commit('updateIsLoading', false)
        },
        async uploadArticlesData({ commit, state }, formData) {
            try {
                await axios.post('api/articles/import', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                notify(commit, SUCCESS)
            } catch (e) {
                notify(commit, ERROR)
            }
        }
    }
}
