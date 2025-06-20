<template>
  <div class="order-page">
    <h2>📦 我的訂單</h2>

    <div v-if="orders.length === 0" class="no-orders">目前尚無訂單</div>

    <div v-for="order in orders" :key="order.orderID" class="order-card">
      <div class="order-header">
        <p><strong>訂單編號：</strong>{{ order.orderID }}</p>
        <p><strong>日期：</strong>{{ order.orderDate }}</p>
        <p><strong>狀態：</strong>{{ order.status }}</p>
        <p><strong>總金額：</strong>NT$ {{ order.totalAmount }}</p>
      </div>
      <ul class="item-list">
        <li v-for="item in order.items" :key="item.orderItemID" class="item">
          🛒 {{ item.name }} x {{ item.quantity }}（NT$ {{ item.price }}）
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const orders = ref([])

onMounted(async () => {
  const res = await fetch('/DB_finalProject/backend/api/order/user_orders.php', {
    credentials: 'include'
  })
  const data = await res.json()
  if (data.success) {
    orders.value = data.orders
  } else {
    alert(data.message)
  }
})
</script>

<style scoped>
.order-page {
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
}

.order-header p {
  margin: 0.3rem 0;
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
