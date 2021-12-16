import Vue from 'vue'
import Vuex from 'vuex'
import articles from './articles';
import notification from './notification'
import categories from './categories'
import auth from './auth'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
      articles,
      notification,
      categories,
      auth
  }
})
