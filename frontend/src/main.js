import { createApp } from 'vue'
import App from './App.vue'
import router from './router' // �� �u import router�]�o���O index.js�^

createApp(App)
    .use(router) // �� ���U router
    .mount('#app')