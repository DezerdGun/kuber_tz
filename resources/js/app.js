// import './bootstrap';
// import { createApp } from 'vue';
// import Dashboard from './components/Dashboard.vue';

// createApp(Dashboard).mount('#app');

import { createApp } from 'vue';
import axios from 'axios';
import Dashboard from './components/Dashboard.vue';

createApp(Dashboard)
  .use(axios)
  .mount('#app');
