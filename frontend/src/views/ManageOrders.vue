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

  // 如果已出貨就移除該筆訂單，否則重新抓訂單
  if (newStatus === '已出貨') {
    orders.value = orders.value.filter(order => order.orderID !== orderID)
  } else {
    await fetchOrders()
  }
}

onMounted(fetchOrders)
</script>

<template>
  <div>
    <h2>📦 所有訂單管理</h2>
    <div v-if="orders.length === 0">目前沒有訂單</div>

    <div v-for="order in orders" :key="order.orderID" class="order-card">
      <p><strong>訂單編號：</strong>{{ order.orderID }}</p>
      <p><strong>顧客 ID：</strong>{{ order.userID }}</p>
      <p><strong>日期：</strong>{{ order.orderDate }}</p>
      <p><strong>總金額：</strong>{{ order.totalAmount }} 元</p>

      <p>
        <strong>狀態：</strong>
        <select v-model="order.status" @change="updateStatus(order.orderID, order.status)">
          <option value="pending">pending</option>
          <option value="已出貨">已出貨</option>
        </select>
      </p>

      <ul>
        <li v-for="item in order.items" :key="item.orderItemID">
          {{ item.name }} x {{ item.quantity }}（{{ item.price }} 元）
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
.order-card {
  border: 1px solid #ccc;
  padding: 1rem;
  margin: 1.5rem 0;
  background: #f9f9f9;
  border-left: 5px solid #87ceeb;
}
select {
  padding: 0.3rem;
  font-size: 0.9rem;
}
</style>
