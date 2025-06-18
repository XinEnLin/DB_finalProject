<template>
  <div class="boss-dashboard">
    <h2>新增商品</h2>
    <input v-model="name" placeholder="商品名稱" />
    <input v-model.number="price" type="number" placeholder="價格" />
    <input v-model.number="stock" type="number" placeholder="庫存" />
    <input v-model="category" placeholder="分類" />
    <textarea v-model="description" placeholder="商品描述"></textarea>
    <input type="file" @change="onFileChange" accept="image/*" />
    <div v-if="imagePath">
      <p>預覽圖片：</p>
      <img :src="imagePath" alt="預覽圖" style="max-width: 150px;" />
    </div>
    <button @click="submit">加入商品</button>
    <p v-if="message">{{ message }}</p>

    <h2>商品列表</h2>
    <div v-if="productList.length === 0">📭 沒有商品</div>
    <ul v-else class="product-list">
      <li v-for="product in productList" :key="product.productID">
        <img :src="product.imagePath" alt="商品圖" style="width: 100px" />
        <div>
          <strong>{{ product.name }}</strong><br />
          NT$ {{ product.price }} - 庫存：{{ product.stock }} - 分類：{{ product.category }}
        </div>
        <button @click="deleteProduct(product.productID)">❌ 刪除</button>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const name = ref('')
const price = ref(0)
const stock = ref(0)
const category = ref('')
const description = ref('')
const imagePath = ref('')
const imageFile = ref(null)
const message = ref('')
const productList = ref([])

const fetchProductList = async () => {
  const res = await fetch('/DB_finalProject/backend/api/products/list_product.php', {
    credentials: 'include'
  })
  productList.value = await res.json()
}

const onFileChange = async (e) => {
  const file = e.target.files[0]
  if (!file) return
  imageFile.value = file

  const formData = new FormData()
  formData.append('image', file)

  try {
    const res = await fetch('/DB_finalProject/backend/api/products/upload_image.php', {
      method: 'POST',
      credentials: 'include',
      body: formData
    })
    const data = await res.json()
    if (data.success) {
      imagePath.value = data.path
    } else {
      alert(data.message || '圖片上傳失敗')
    }
  } catch (err) {
    alert('圖片上傳失敗')
  }
}

const submit = async () => {
  message.value = ''
  try {
    const res = await fetch('/DB_finalProject/backend/api/products/add_product.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({
        name: name.value,
        price: price.value,
        stock: stock.value,
        category: category.value,
        description: description.value,
        imagePath: imagePath.value
      })
    })
    const data = await res.json()
    message.value = data.message

    if (data.success) {
      name.value = ''
      price.value = 0
      stock.value = 0
      category.value = ''
      description.value = ''
      imagePath.value = ''
      fetchProductList()
    }
  } catch (err) {
    message.value = '新增失敗，請稍後再試'
  }
}

const deleteProduct = async (productID) => {
  if (!confirm('確定要刪除這個商品嗎？')) return

  try {
    const res = await fetch('/DB_finalProject/backend/api/products/delete_product.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({ productID })
    })

    const data = await res.json()
    if (data.success) {
      productList.value = productList.value.filter(p => p.productID !== productID)
    } else {
      alert(data.message || '刪除失敗')
    }
  } catch (err) {
    alert('刪除失敗，API 發生錯誤')
  }
}

onMounted(fetchProductList)
</script>

<style scoped>
.boss-dashboard {
  padding: 2rem;
  max-width: 800px;
  margin: 0 auto;
}
input, textarea {
  display: block;
  margin: 0.5rem 0;
  width: 100%;
  padding: 0.5rem;
}
button {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
}
.product-list {
  list-style: none;
  padding: 0;
}
.product-list li {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin: 1rem 0;
  border-bottom: 1px solid #ccc;
  padding-bottom: 1rem;
}
</style>
