import Vue from 'vue'
import Vuex from 'vuex'
import articles from './articles';
import notification from './notification'
import categories from './categories'

Vue.use(Vuex)

export const index = new Vuex.Store({
  modules: { articles, notification, categories }
})
