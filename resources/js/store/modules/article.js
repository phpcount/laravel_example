export const namespaced = true

export const state = {
  item: {
    comments: [],
    tags: [],
    statistic: {
      likes: 0,
      views: 0
    }
  },
  likeIt: true,
  commentSuccess: false,
  errors: []
}

export const actions = {
  getArticleData({ commit, rootState }) {
    axios.get('/api/article', { params: { slug: rootState.slug } }).then((response) => {
      commit('SET_ARTICLE', response.data.data)
    }).catch((error) => {
      console.error(error)
    });
  },
  viewsIncrement({ commit, rootState }) {
    setTimeout(() => {
      axios.put('/api/article/views/inc', { slug: rootState.slug }).then((response) => {
        commit('SET_ARTICLE', response.data.data)
      }).catch(() => {
        console.error(error)
      });
    }, 5000)
  },
  addLike({ commit }, payload) {
    axios.put('/api/article/likes/inc', { slug: payload.slug, type_counter: payload.type_counter }).then((response) => {
      commit('SET_ARTICLE', response.data.data)
      commit('SET_LIKE', !state.likeIt)
    }).catch(() => {
      console.error(error)
    });
  },
  addComment({ commit, dispatch, rootState }, payload) {
    axios.post('/api/article/comment/add', { subject: payload.subject, body: payload.body, article_id: payload.article_id }).then((response) => {
      commit('SET_COMMENT_SUCCESS', !state.commentSuccess)
      dispatch('getArticleData', rootState.slug)
    }).catch((error) => {
      if (error.response.status === 422) {
        commit('SET_ERRORS', error.response.data.errors);
      }
    });
  }

}

export const getters = {
  articleLikes(state) {
    return state.item.statistic.likes;
  },
  articleViews(state) {
    return state.item.statistic.views;
  }
}

export const mutations = {
  SET_ARTICLE(state, payload) {
    state.item = payload;
  },
  SET_LIKE(state, payload) {
    state.likeIt = payload;
  },
  SET_COMMENT_SUCCESS(state, payload) {
    state.commentSuccess = payload;
  },
  SET_ERRORS(state, errors) {
    state.errors = errors;
  }
}
