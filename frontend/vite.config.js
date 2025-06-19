import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [vue()],
    server: {
        proxy: {
            // 讓所有 /DB_finalProject 開頭的請求自動轉給 Apache（通常 80 port）
            '/DB_finalProject': {
                target: 'http://localhost:8080', // 這是 Apache 跑的 host
                changeOrigin: true,
                secure: false,
            },
        },
    },
})