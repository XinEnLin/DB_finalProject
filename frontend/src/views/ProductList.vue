<template>
  <div class="product-list">
    <h2>商品列表</h2>

    <div v-if="loading">🔄 載入中...</div>
    <div v-else-if="products.length === 0">📭 目前沒有商品</div>
    <div v-else class="product-grid">
      <div v-for="product in products" :key="product.productID" class="product-card">
        <img v-if="product.imagePath" :src="product.imagePath  || '/images/default.png'" alt="商品圖片" />
        <h3>{{ product.name }}</h3>
        <p class="price">價格：NT$ {{ product.price }}</p>
        <p class="category">分類：{{ product.category }}</p>
        <p class="stock">庫存：{{ product.stock }}</p>
        <p class="desc">{{ product.description }}</p>
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
    const res = await fetch('/DB_finalProject/backend/api/products/list_product.php', {
      credentials: 'include'
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
.product-card img {
  width: 100%;
  height: auto;
  border-radius: 8px;
  object-fit: cover;
  margin-bottom: 0.5rem;
}
.product-card h3 {
  margin: 0.5rem 0;
}
.price {
  font-weight: bold;
  color: #333;
}
.category, .stock, .desc {
  font-size: 0.9rem;
  color: #666;
}
</style>
