<template>
  <div class="cart">
    <h2>🛒 購物車</h2>
    <div v-if="items.length === 0" class="empty-message">您的購物車是空的</div>
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

.cart {
  max-width: 900px;
  margin: 2rem auto;
  padding: 2rem;
  background: rgba(255, 255, 255, 0.08);
  border-radius: 12px;
  backdrop-filter: blur(10px);
  color: white;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

h2 {
  text-align: center;
  margin-bottom: 1.5rem;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 12px;
  overflow: hidden;
  margin-top: 1rem;
  background-color: rgba(255, 255, 255, 0.05);
}

th, td {
  padding: 0.75rem;
  text-align: center;
  color: white;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

th {
  background-color: rgba(0, 188, 212, 0.5);
  font-weight: bold;
}

img {
  border-radius: 8px;
  width: 60px;
  height: auto;
}

button {
  background-color: #00bcd4;
  color: white;
  border: none;
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}

button:hover {
  background-color: #0097a7;
}

.actions {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  display: flex;
  gap: 1rem;
  z-index: 100;
}

.actions button {
  background-color: #4caf50;
  border: none;
  padding: 0.8rem 1.2rem;
  font-size: 1rem;
  border-radius: 10px;
  color: white;
  font-weight: bold;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  transition: background-color 0.2s;
}

.actions button:first-child {
  background-color: #f44336;
}

.actions button:hover {
  opacity: 0.9;
}

h3 {
  margin-top: 1.5rem;
  margin-bottom: 5rem;
  text-align: right;
  color: #ffeb3b;
}

td button:first-of-type,
td button:last-of-type {
  width: 2rem;
  padding: 0.2rem;
}

.empty-message {
  text-align: center;
  font-size: 1.2rem;
  color: #ffcccb;
  margin-top: 2rem;
}

</style>
