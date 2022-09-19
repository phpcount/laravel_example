import { createStore } from 'vuex'

import * as article from './modules/article'

const store = {
  modules: {
    article
  },
  state: {
    slug: '',
  },
  actions: {
    setSlug({ commit }, value) {
      commit('SET_SLUG', value);
    }
  },
  getters: {
    articleSlugRevers(state) {
      return state.slug.split('').reverse().join('');
    },
  },
  mutations: {
    SET_SLUG(state, payload) {
      state.slug = payload;
    }
  },
	strict: process.env.NODE_ENV !== 'production'
}

export default createStore(store);
