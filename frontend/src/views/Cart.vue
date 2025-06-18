<template>
  <div class="cart">
    <h2>🛒 購物車</h2>
    <div v-if="items.length === 0">您的購物車是空的</div>
    <table v-else>
      <thead>
        <tr>
          <th>圖片</th>
          <th>商品</th>
          <th>單價</th>
          <th>數量</th>
          <th>小計</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.cartID">
          <td><img :src="item.imagePath" width="60" /></td>
          <td>{{ item.name }}</td>
          <td>NT$ {{ item.price }}</td>
          <td>
            <button @click="updateQuantity(item, item.quantity - 1)" :disabled="item.quantity <= 1">－</button>
            {{ item.quantity }}
            <button @click="updateQuantity(item, item.quantity + 1)">＋</button>
          </td>
          <td>NT$ {{ item.price * item.quantity }}</td>
          <td><button @click="deleteItem(item.cartID)">刪除</button></td>
        </tr>
      </tbody>
    </table>
    <h3 v-if="items.length">總金額：NT$ {{ total }}</h3>

    <div class="actions" v-if="items.length">
      <button @click="clearCart">🧹 清空購物車</button>
      <button @click="checkout">✅ 結帳</button>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'

const items = ref([])

const fetchCart = async () => {
  const res = await fetch('/DB_finalProject/backend/api/cart/list_cart.php', {
    credentials: 'include'
  })
  items.value = await res.json()
}

const deleteItem = async (cartID) => {
  const res = await fetch('/DB_finalProject/backend/api/cart/delete_cart.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify({ cartID })
  })
  const data = await res.json()
  if (data.success) {
    items.value = items.value.filter(i => i.cartID !== cartID)
  }
}

const updateQuantity = async (item, newQty) => {
  if (newQty < 1) return
  const res = await fetch('/DB_finalProject/backend/api/cart/update_cart.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include',
    body: JSON.stringify({ cartID: item.cartID, quantity: newQty })
  })
  const data = await res.json()
  if (data.success) {
    item.quantity = newQty
  }
}

const clearCart = async () => {
  if (!confirm('確定要清空購物車？')) return
  const res = await fetch('/DB_finalProject/backend/api/cart/clear_cart.php', {
    method: 'POST',
    credentials: 'include'
  })
  const data = await res.json()
  if (data.success) {
    items.value = []
  } else {
    alert(data.message || '清空失敗')
  }
}

const checkout = async () => {
  if (!confirm('確定要結帳嗎？')) return
  const res = await fetch('/DB_finalProject/backend/api/cart/checkout_cart.php', {
    method: 'POST',
    credentials: 'include'
  })
  const data = await res.json()
  if (data.success) {
    alert(data.message)
    items.value = []
  } else {
    alert(data.message || '結帳失敗')
  }
}

const total = computed(() =>
  items.value.reduce((sum, i) => sum + i.price * i.quantity, 0)
)

onMounted(fetchCart)
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
}
th, td {
  border: 1px solid #ccc;
  padding: 0.5rem;
  text-align: center;
}
img {
  border-radius: 4px;
}
button {
  padding: 0.2rem 0.5rem;
}
</style>
