<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'

const user = ref(null)
const router = useRouter()

const fetchUser = async () => {
  const res = await fetch('/DB_finalProject/backend/api/auth/me.php', {
    credentials: 'include'
  })
  const data = await res.json()
  if (data.loggedIn) {
    user.value = { username: data.username, role: data.role }
  } else {
    user.value = null
  }
}

onMounted(fetchUser)

const logout = async () => {
  await fetch('/DB_finalProject/backend/api/auth/logout.php', {
    credentials: 'include'
  })
  user.value = null
  router.push('/login')
}
</script>

<template>
  <div id="app">
    <!-- 右上角狀態區塊 -->
    <div style="position: fixed; top: 20px; right: 40px; z-index: 99;">
      <template v-if="user">
        <span>歡迎，{{ user.username }}</span>
        <button @click="logout" style="margin-left:10px;">登出</button>

      </template>
      <template v-else>
        <RouterLink to="/login">請先登入</RouterLink>
      </template>
    </div>

    <nav class="banner">
      <RouterLink to="/">首頁</RouterLink>
      <RouterLink to="/products">商品列表</RouterLink>

      <!-- 一般用戶看到的選單 -->
      <template v-if="user && user.role === 'user'">
        <RouterLink to="/cart">購物車</RouterLink>
        <RouterLink to="/orders">查看訂單</RouterLink>
      </template>
      <!-- boss 看到的選單 -->
      <template v-else-if="user && user.role === 'boss'">
        <RouterLink to="/manage-orders">管理訂單</RouterLink>
        <RouterLink to="/manage-products">管理商品</RouterLink>
      </template>
      
    </nav>
    <main class="center-content">
    <!-- 監聽 login-success 事件 -->
      <RouterView @login-success="fetchUser" />
    </main>
  </div>
</template>

<style scoped>
.banner {
  background: #87ceeb; /* 天空藍 */
  padding: 1rem 0;
  display: flex;
  justify-content: center;
  gap: 2rem;
}
.banner a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  font-size: 1.1rem;
  transition: color 0.2s;
}
.banner a:hover,
.banner a.router-link-active {
  color: #333;
}
.center-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 60vh; /* 內容區至少佔 60% 視窗高度 */
}
</style>
