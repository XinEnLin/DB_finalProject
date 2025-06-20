<template>
  <div class="product-list">
    <h2>商品列表</h2>

    <div style="margin-top: 1rem;">
      <label for="sort">排序方式：</label>
      <select id="sort" v-model="sortOption">
        <option value="default">預設排序</option>
        <option value="priceAsc">價格：低到高</option>
        <option value="priceDesc">價格：高到低</option>
        <option value="stockDesc">庫存：多到少</option>
      </select>

      <label for="categoryFilter">分類：</label>
      <select id="categoryFilter" v-model="categoryFilter">
        <option value="">全部分類</option>
        <option
          v-for="cat in availableCategories"
          :key="cat"
          :value="cat"
        >
          {{ cat }}
        </option>
      </select>
    </div>

    <div style="margin-top: 1rem;">
      <input
        v-model="searchText"
        type="text"
        placeholder="搜尋商品名稱或分類"
        style="padding: 0.5rem; width: 60%; border-radius: 8px; border: 1px solid #ccc;"
      />
    </div>

    <div v-if="loading">🔄 載入中...</div>
    <div v-else-if="products.length === 0">📭 目前沒有商品</div>
    <div v-else class="product-grid">
      <div v-for="product in filteredProducts" :key="product.productID" class="product-card">
        <img v-if="product.imagePath" :src="product.imagePath  || '/images/default.png'" alt="商品圖片" />
        <h3>{{ product.name }}</h3>
        <p class="price" style="color: white;">價格：NT$ {{ product.price }}</p>
        <p class="category" style="color: white;">分類：{{ product.category }}</p>
        <p class="stock" style="color: white;">庫存：{{ product.stock }}</p>
        <p class="desc" style="color: white;">{{ product.description }}</p>
        <button @click="addToCart(product.productID)">加入購物車</button>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted,computed } from 'vue'

const products = ref([])
const loading = ref(true)
const sortOption = ref('default')
const searchText = ref('')
const categoryFilter = ref('')

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

const addToCart = async (productID) => {
  try {
    const res = await fetch('/DB_finalProject/backend/api/cart/add_cart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ productID, quantity: 1 })
    })
    const data = await res.json()
    alert(data.message || '加入購物車成功')
  } catch (err) {
    alert('加入購物車失敗，請稍後再試')
  }
}

const sortedProducts = computed(() => {
  if (sortOption.value === 'priceAsc') {
    return [...products.value].sort((a, b) => a.price - b.price)
  } else if (sortOption.value === 'priceDesc') {
    return [...products.value].sort((a, b) => b.price - a.price)
  } else if (sortOption.value === 'stockDesc') {
    return [...products.value].sort((a, b) => b.stock - a.stock)
  } else {
    return products.value
  }
})


// 自動從所有商品中取得不重複的分類
const availableCategories = computed(() => {
  const allCategories = products.value.map(p => p.category)
  return [...new Set(allCategories)]
})

// 搜尋與分類篩選結合
const filteredProducts = computed(() => {
  const keyword = searchText.value.toLowerCase()
  return sortedProducts.value.filter(p => {
    const matchSearch =
      p.name.toLowerCase().includes(keyword) ||
      p.category.toLowerCase().includes(keyword)
    const matchCategory =
      !categoryFilter.value || p.category === categoryFilter.value
    return matchSearch && matchCategory
  })
})

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
  background-color: #fdfdfd37;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.product-card img {
  width: 80%;
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
