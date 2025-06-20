<template>
  <div class="register-container">
    <div class="register-card">
      <h2>📝 註冊帳號</h2>

      <input v-model="username" placeholder="帳號" />
      <input v-model="email" placeholder="Email" />
      <input v-model="password" type="password" placeholder="密碼" />
      <input v-model="address" placeholder="地址" />
      <input v-model="phone" placeholder="電話" />

      <button @click="register">註冊</button>
      <div class="message" v-if="message">{{ message }}</div>
    </div>
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
    const res = await fetch('/DB_finalProject/backend/api/auth/register.php', {
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
      // Optional: 導向登入頁
      // window.location.href = '/login'
    }
  } catch (err) {
    message.value = '連線失敗，請稍後再試'
  }
}
</script>

<style scoped>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 80vh;
}

.register-card {
  background-color: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(10px);
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  width: 360px;
  color: white;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  text-align: center;
}

input {
  padding: 0.5rem;
  font-size: 1rem;
  border-radius: 8px;
  border: none;
  outline: none;
  background-color: rgba(255, 255, 255, 0.15);
  color: white;
}

input::placeholder {
  color: rgba(255, 255, 255, 0.6);
}

button {
  background-color: #00bcd4;
  color: white;
  border: none;
  padding: 0.6rem 1rem;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}

button:hover {
  background-color: #0097a7;
}

.message {
  color: #ffc107;
  font-size: 0.9rem;
}
</style>
