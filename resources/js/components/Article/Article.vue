<template>
  <div class="row mt-5">
    <div class="col-12 p-3">
      <img
        :src="article.img"
        class="border rounded mx-auto d-block"
        :alt="article.title"
      />
      <h5 class="mt-5">{{ article.title }}</h5>
      <p>
        <span class="tag" v-for="(tag, index) in article.tags" :key="tag.id">
          <span v-if="tagsLen == index + 1">{{ tag.label }}</span>
          <span v-else>{{ tag.label }} | </span>
        </span>
      </p>
      <p class="card-text">{{ article.body }}</p>
      <p>
        Опубликованно: <i>{{ article.created_at }}</i>
      </p>
      <div class="mt-3">
        <Views />
        <Likes class="ms-2"/>
      </div>
    </div>
  </div>
</template>


<script>
import { computed } from "vue";
import { useStore } from "vuex";

import Views from "./Views.vue";
import Likes from "./Likes.vue";

export default {
  setup() {
    const store = useStore();

    const article = computed(() => store.state.article.item);
    const tagsLen = computed(() => store.state.article.item.tags.length);

    return {
      article,
      tagsLen,
    };
  },
  components: { Views, Likes },
};
</script>
