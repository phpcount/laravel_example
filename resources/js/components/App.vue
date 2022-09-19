<template>
  <div class="container">
    <Article />
    <hr />
    <Comments />
  </div>
</template>

<script>
import { onMounted } from "vue";
import { useStore } from "vuex";
import Article from "./Article/Article.vue";
import Comments from "./Article/Comments.vue";
export default {
  setup() {
    const url = window.location.pathname;
    const slug = url.substring(url.lastIndexOf("/") + 1);
    const store = useStore();

    onMounted(() => {
      store.dispatch('setSlug', slug);
      store.dispatch("article/getArticleData");
      store.dispatch("article/viewsIncrement");
    });
  },
  components: { Article, Comments },
};
</script>
