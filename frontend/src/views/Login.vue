<template>
  <div>
    <h2>登入</h2>
    <input v-model="username" placeholder="帳號" />
    <input v-model="password" type="password" placeholder="密碼" />
    <button @click="login">登入</button>
    <div v-if="message">{{ message }}</div>

    <!-- 註冊按鈕 -->
    <div style="margin-top: 1rem;">
      還沒有帳號？
      <router-link to="/register">
        <button style="margin-left: 0.5rem;">註冊</button>
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

//告訴 Vue 你要發出 login-success 事件
const emit = defineEmits(['login-success'])

const username = ref('')
const password = ref('')
const message = ref('')

const login = async () => {
  message.value = ''
  try {
    const res = await fetch('http://localhost/DB_finalProject/backend/api/auth/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ username: username.value, password: password.value }),
    })
    const data = await res.json()
    message.value = data.message
    if (data.success) {
      emit('login-success')   // 登入成功後發事件
      // router.push('/')  // 可選，導頁
    }
  } catch (err) {
    message.value = err.message || '連線失敗，請稍後再試'
  }
}
</script>
