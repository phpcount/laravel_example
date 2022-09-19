<template>
  <div class="row">
    <form @submit.prevent="submit" v-if="!commentSuccess">
      <div class="mb-3">
        <label for="commentSubject" class="form-label">Тема комментария</label>
        <input
          type="text"
          class="form-control"
          id="commentSubject"
          v-model="subject"
        />
        <div
          class="alert alert-warning"
          role="alert"
          v-if="errorsMessage.subject"
        >
          {{ errorsMessage.subject[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="commentBody" class="form-label">Комментарий</label>
        <textarea
          class="form-control"
          id="commentBody"
          rows="3"
          v-model="body"
        ></textarea>
        <div class="alert alert-warning" role="alert" v-if="errorsMessage.body">
          {{ errorsMessage.body[0] }}
        </div>
      </div>
      <button class="btn btn-success" type="submit">Отправить</button>
    </form>
    <div class="alert alert-success" role="alert" v-else>
      Комментарий успешно отправлен!
    </div>
    <div
      class="container pb-2 mt-3 mx-auto"
      v-for="comment in comments"
      :key="comment.id"
    >
      <div class="toast show w-100">
        <div class="toast-header">
          <img
            src="https://via.placeholder.com/50/5F113B/FFFFFF/?text=User"
            class="rounded me-2"
            :alt="comment.subject"
          />
          <strong class="me-auto">{{ comment.subject }}</strong>
          <small class="text-muted">{{ comment.created_at }}</small>
        </div>
        <div class="toast-body">
          {{ comment.body }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, reactive, toRefs } from 'vue';
import { useStore } from 'vuex';

export default {
  setup() {
    const data = reactive({
      subject: "",
      body: ""
    });
    const store = useStore();

    const comments = computed(() => store.state.article.item.comments);
    const commentSuccess = computed(() => store.state.article.commentSuccess);
    const errorsMessage = computed(() => store.state.article.errors);


    function submit() {
      store.dispatch("article/addComment", {
        ..._.cloneDeep(data),
        article_id: store.state.article.item.id,
      });
    }

    return {
      ...toRefs(data),
      comments,
      commentSuccess,
      errorsMessage,
      submit
    }
  }
};
</script>

<style scoped>
</style>
