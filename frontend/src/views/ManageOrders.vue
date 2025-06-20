<template>
  <div class="boss-order-page">
    <h2>所有訂單管理</h2>

    <div v-if="orders.length === 0" class="no-orders">目前沒有訂單</div>

    <div v-for="order in orders" :key="order.orderID" class="order-card">
      <div class="order-header">
        <p><strong>訂單編號：</strong>{{ order.orderID }}</p>
        <p><strong>顧客 ID：</strong>{{ order.userID }}</p>
        <p><strong>日期：</strong>{{ order.orderDate }}</p>
        <p><strong>總金額：</strong>NT$ {{ order.totalAmount }}</p>

        <label class="status-label">
          狀態：
          <select v-model="order.status" @change="updateStatus(order.orderID, order.status)">
            <option value="pending">⏳ 處理中</option>
            <option value="已出貨">✅ 已出貨</option>
          </select>
        </label>
      </div>

      <ul class="item-list">
        <li v-for="item in order.items" :key="item.orderItemID" class="item">
          🛍️ {{ item.name }} x {{ item.quantity }}（NT$ {{ item.price }}）
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const orders = ref([])

const fetchOrders = async () => {
  const res = await fetch('/DB_finalProject/backend/api/order/boss_orders.php', {
    credentials: 'include'
  })
  const data = await res.json()
  if (data.success) {
    orders.value = data.orders
  } else {
    alert(data.message)
  }
}

const updateStatus = async (orderID, newStatus) => {
  const res = await fetch('/DB_finalProject/backend/api/order/update_order_status.php', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ orderID, status: newStatus })
  })

  const data = await res.json()
  alert(data.message)

  if (newStatus === '已出貨') {
    orders.value = orders.value.filter(order => order.orderID !== orderID)
  } else {
    await fetchOrders()
  }
}

onMounted(fetchOrders)
</script>

<style scoped>
.boss-order-page {
  max-width: 900px;
  margin: 2rem auto;
  padding: 1.5rem;
  color: white;
  backdrop-filter: blur(10px);
  border-radius: 12px;
}

h2 {
  text-align: center;
  margin-bottom: 2rem;
}

.no-orders {
  text-align: center;
  font-size: 1.2rem;
  color: #ffcdd2;
  background: rgba(255, 255, 255, 0.1);
  padding: 1rem;
  border-radius: 8px;
}

.order-card {
  background-color: rgba(255, 255, 255, 0.05);
  padding: 1.2rem;
  margin-bottom: 1.5rem;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  border-left: 5px solid #03a9f4;
}

.order-header p {
  margin: 0.4rem 0;
}

.status-label {
  display: block;
  margin-top: 1rem;
  font-weight: bold;
}

select {
  padding: 0.3rem 0.5rem;
  margin-left: 0.5rem;
  font-size: 0.9rem;
  border-radius: 6px;
  border: none;
  background-color: #fff;
  color: #333;
}

select:hover {
  background-color: #f0f0f0;
}

.item-list {
  margin-top: 1rem;
  padding-left: 1.5rem;
}

.item {
  margin-bottom: 0.5rem;
  color: #ffe082;
}
</style>
