<template>
  <div class="welcome-container">
    <h1> 歡迎來到超讚小店 </h1>
    <p>這裡是我們的首頁，歡迎瀏覽商品與註冊成為會員！</p>
    <button @click="goToMain" class="start-button">開始探索</button>
  </div>
</template>

<script>
import { useRouter } from 'vue-router'

export default {
  setup() {
    const router = useRouter()
    const goToMain = () => {
      router.push('/products') // 這邊對應你路由表的 path
    }
    return { goToMain }
  }
}
</script>

<style scoped>
.welcome-container {
  font-size: 36px;
  text-align: center;
  margin-top: 10vh;
  color: white;
}
.start-button {
  margin-top: 1.5rem;
  padding: 0.5rem 1.2rem;
  font-size: 1.2rem;
  border: none;
  background-color: white;
  color: black;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.start-button:hover {
  background-color: rgb(193, 193, 37);
}
</style>
