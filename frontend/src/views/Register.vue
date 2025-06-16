<template>
  <div>
    <h2>註冊</h2>
    <input v-model="username" placeholder="帳號" />
    <input v-model="email" placeholder="Email" />
    <input v-model="password" type="password" placeholder="密碼" />
    <input v-model="address" placeholder="地址" />
    <input v-model="phone" placeholder="電話" />
    <button @click="register">註冊</button>
    <div v-if="message">{{ message }}</div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const username = ref('')
const email = ref('')
const password = ref('')
const address = ref('')
const phone = ref('')
const message = ref('')

const register = async () => {
  message.value = ''
  try {
    const res = await fetch('http://localhost/DB_finalProject/backend/api/auth/register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        username: username.value,
        email: email.value,
        password: password.value,
        address: address.value,
        phone: phone.value
      })
    })
    const data = await res.json()
    message.value = data.message
    if (data.success) {
      // 可加清空欄位或導向登入頁
      // username.value = email.value = password.value = address.value = phone.value = ''
      // window.location.href = "/login"
    }
  } catch (err) {
    message.value = '連線失敗，請稍後再試'
  }
}
</script>
