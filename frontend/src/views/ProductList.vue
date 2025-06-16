<template>
  <div class="product-list">
    <h2>商品列表</h2>

    <div v-if="loading">載入中...</div>
    <div v-else-if="products.length === 0">目前沒有商品</div>
    <div v-else class="product-grid">
      <div v-for="product in products" :key="product.id" class="product-card">
        <h3>{{ product.name }}</h3>
        <p>{{ product.description }}</p>
        <p>價格：NT$ {{ product.price }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const products = ref([])
const loading = ref(true)

const fetchProducts = async () => {
  try {
    const res = await fetch('/DB_finalProject/backend/api/product/list_product.php', {
      credentials: 'include',
    })
    const data = await res.json()
    products.value = data
  } catch (err) {
    console.error('取得商品資料失敗', err)
    products.value = []
  } finally {
    loading.value = false
  }
}

onMounted(fetchProducts)
</script>

<style scoped>
.product-list {
  text-align: center;
  padding: 2rem;
}
.product-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 2rem;
  margin-top: 2rem;
}
.product-card {
  width: 250px;
  border: 1px solid #ddd;
  border-radius: 12px;
  padding: 1rem;
  background-color: #fdfdfd;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.product-card h3 {
  margin-bottom: 0.5rem;
}
</style>
