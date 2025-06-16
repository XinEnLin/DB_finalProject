import { createApp } from 'vue'
import App from './App.vue'
import router from './router' // ← 只 import router（這其實是 index.js）

createApp(App)
    .use(router) // ← 註冊 router
    .mount('#app')