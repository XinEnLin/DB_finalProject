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

<template>
  <div>
    <h2>我的訂單</h2>
    <div v-if="orders.length === 0">尚無訂單</div>
    <div v-for="order in orders" :key="order.orderID" class="order-card">
      <p><strong>訂單編號：</strong>{{ order.orderID }}</p>
      <p><strong>日期：</strong>{{ order.orderDate }}</p>
      <p><strong>狀態：</strong>{{ order.status }}</p>
      <p><strong>總金額：</strong>{{ order.totalAmount }}</p>
      <ul>
        <li v-for="item in order.items" :key="item.orderItemID">
          {{ item.name }} x {{ item.quantity }}（單價：{{ item.price }}）
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
.order-card {
  border: 1px solid #ccc;
  padding: 1rem;
  margin: 1rem 0;
  background: #f8f8f8;
}
</style>
