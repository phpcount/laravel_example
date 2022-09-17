import './bootstrap';

import { createApp } from 'vue';
import App from './blog/App.vue';

const app = createApp(App)
  // .use()
  .mount("#app");
