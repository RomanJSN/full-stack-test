import axios from 'axios'

export default {
  namespaced: true,
  state: () => ({
    articles: []
  }),
  getters: {
    getArticles(state) {
      return state.articles
    }
  },
  mutations: {
    updateArticles(state, articles) {
      state.articles = articles
    }
  },
  actions: {
    async getArticles(state) {
      try {
        await axios.post('api/articles')
      } catch (e) {

      }
    },
    uploadArticlesData({ state }, file) {
      const formData = new FormData();
      formData.append('file', file);
      return axios.post('api/articles/import', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
    }
  }
}
