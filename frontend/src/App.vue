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
    <header class="image-header">
      <!-- 如果你要讓 logo/導覽選單 疊在圖片上 -->
      <div class="header-overlay">
        <div class="left-section">
          <router-link to="/" class="logo-link">
            <img src="/images/logo.png" alt="Logo" class="logo" />
          </router-link>
        </div>

        <nav class="nav-links">
          <RouterLink to="/">首頁</RouterLink>
          <RouterLink to="/products">商品列表</RouterLink>
          <template v-if="user && user.role === 'user'">
            <RouterLink to="/cart">購物車</RouterLink>
            <RouterLink to="/orders">查看訂單</RouterLink>
          </template>
          <template v-else-if="user && user.role === 'admin'">
            <RouterLink to="/manage-orders">管理訂單</RouterLink>
            <RouterLink to="/manage-products">管理商品</RouterLink>
          </template>
        </nav>

        <div class="user-status">
          <template v-if="user">
            <span>歡迎，{{ user.username }}</span>
            <button @click="logout">登出</button>
          </template>
          <template v-else>
            <RouterLink to="/login" style = "color: white;
            background-color:  darkred;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: bold;">請先登入</RouterLink>
          </template>
        </div>
      </div>
    </header>

    <main class="center-content">
    <!-- 監聽 login-success 事件 -->
      <RouterView @login-success="fetchUser" />
    </main>
  </div>
</template>

<style scoped>

</style>
