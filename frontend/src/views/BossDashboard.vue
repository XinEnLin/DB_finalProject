<template>
  <div class="boss-dashboard">
    <h2>老闆商品新增介面</h2>
    <form @submit.prevent="submit">
      <input v-model="name" placeholder="商品名稱" required />
      <input v-model.number="price" placeholder="價格" required type="number" />
      <textarea v-model="description" placeholder="描述" rows="3" />
      <button type="submit">新增商品</button>
    </form>
    <div v-if="message">{{ message }}</div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const name = ref('')
const price = ref(0)
const description = ref('')
const message = ref('')

const submit = async () => {
  message.value = ''
  try {
    const res = await fetch('/DB_finalProject/backend/api/product/add_product.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({
        name: name.value,
        price: price.value,
        description: description.value
      })
    })
    const data = await res.json()
    message.value = data.message
    if (data.success) {
      name.value = ''
      price.value = 0
      description.value = ''
    }
  } catch (err) {
    message.value = '新增失敗，請稍後再試'
  }
}
</script>

<style scoped>
.boss-dashboard {
  max-width: 500px;
  margin: 2rem auto;
}
form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
input, textarea {
  padding: 0.5rem;
  font-size: 1rem;
}
button {
  padding: 0.5rem 1rem;
  background-color: #87ceeb;
  color: white;
  border: none;
  cursor: pointer;
}
</style>
