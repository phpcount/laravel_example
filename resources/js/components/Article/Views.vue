<template>
  <span class="badge bg-danger">{{viewsNumber}} <i class="far fa-eye"></i></span>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore();

    const viewsNumber = computed(() => store.getters['article/articleViews']);

    return {
      viewsNumber
    };
  },
}
</script>
