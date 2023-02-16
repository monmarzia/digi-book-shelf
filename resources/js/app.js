import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';

const router = createRouter({
    history: createWebHistory(),
    routes
});

const app = createApp({});

import FrontPage from './components/FrontPage.vue';
app.component('front-page', FrontPage);



app.use(router).mount('#app');
