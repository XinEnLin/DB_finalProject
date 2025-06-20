<template>
  <div class="login-container">
    <div class="login-card">
      <h2>登入</h2>
      <input v-model="username" placeholder="帳號" />
      <input
        v-model="password"
        :type="showPassword ? 'text' : 'password'"
        placeholder="密碼"
      />
      <!-- 顯示密碼切換 -->
      <label class="checkbox">
        <input type="checkbox" v-model="showPassword" />
        顯示密碼
      </label>

      <!-- 記住我 -->
      <label class="checkbox">
        <input type="checkbox" v-model="rememberMe" />
        記住我
      </label>

      <button @click="login">登入</button>
      <div v-if="message" class="message">{{ message }}</div>

      <div class="register-area">
        <span>還沒有帳號？</span>
        <router-link to="/register"><button class="register-btn">註冊</button></router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref,onMounted } from 'vue'
const emit = defineEmits(['login-success'])

const username = ref('')
const password = ref('')
const message = ref('')
const showPassword = ref(false)
const rememberMe = ref(false)

onMounted(() => {
  // 如果曾經記住帳號，就填上
  const savedUser = localStorage.getItem('rememberedUser')
  if (savedUser) {
    username.value = savedUser
    rememberMe.value = true
  }
})

const login = async () => {
  message.value = ''
  try {
    const res = await fetch('/DB_finalProject/backend/api/auth/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ username: username.value, password: password.value }),
    })
    const data = await res.json()
    message.value = data.message
    if (data.success) {
      // ✅ 如果有勾選記住我，儲存帳號
      if (rememberMe.value) {
        localStorage.setItem('rememberedUser', username.value)
      } else {
        localStorage.removeItem('rememberedUser')
      }
      emit('login-success')
    }
  } catch (err) {
    message.value = err.message || '連線失敗，請稍後再試'
  }
}
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 70vh;
}

.login-card {
  background-color: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
  width: 320px;
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
  color: #ffcc00;
  font-size: 0.9rem;
  margin-top: -0.5rem;
}

.register-area {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
  margin-top: 1rem;
}

.register-btn {
  background-color: #4caf50;
}

.register-btn:hover {
  background-color: #388e3c;
}

.checkbox {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  color: #ccc;
  margin-top: -0.5rem;
}
</style>
