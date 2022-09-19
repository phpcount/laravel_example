<template>
  <span
    @click="addLike()"
    class="badge"
    :class="[likeIt ? 'bg-primary' : 'bg-danger', $style['btnLikes']]"
    >{{ articleLikes }} <i class="far fa-thumbs-up"></i
  ></span>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore();

    const likeIt = computed(() => store.state.article.likeIt);
    const articleLikes = computed(() => store.getters['article/articleLikes']);

    function addLike() {
      store.dispatch("article/addLike", {
        slug: store.state.slug,
        type_counter: likeIt.value ? 'increment': 'decrement',
      });
    }

    return {
      likeIt,
      articleLikes,
      addLike
    };
  },
};
</script>

<style module>
.btnLikes {
  cursor: pointer;
}
</style>
