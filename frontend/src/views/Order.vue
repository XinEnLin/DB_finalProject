<template>
  <div class="order-page">
    <h2>📦 我的訂單</h2>

    <div v-if="orders.length === 0" class="no-orders">目前尚無訂單</div>

    <div
      v-for="(order, index) in orders"
      :key="order.orderID"
      class="order-card"
      :id="`order-${order.orderID}`"
      
    >
      <div class="order-header">
        <p><strong>訂單編號：</strong>{{ order.orderID }}</p>
        <p><strong>日期：</strong>{{ order.orderDate }}</p>
        <p><strong>狀態：</strong>{{ order.status }}</p>
        <p><strong>總金額：</strong>NT$ {{ order.totalAmount }}</p>

        <button class="toggle-btn" @click="toggleDetails(index)">
          {{ expanded[index] ? '▲ 收合明細' : '▼ 展開明細' }}
        </button>

        <button class="download-btn" @click="downloadInvoice(index)">
          📄 下載發票
        </button>
      </div>

      <ul class="item-list" v-show="expanded[index]">
        <li
          v-for="item in order.items"
          :key="item.orderItemID"
          class="item"
        >
          🛒 {{ item.name }} x {{ item.quantity }}（NT$ {{ item.price }}）
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted,nextTick } from 'vue'
import jsPDF from 'jspdf'
import html2canvas from 'html2canvas'

const orders = ref([])
const expanded = ref([]) // 控制每筆訂單展開與否

onMounted(async () => {
  const res = await fetch('/DB_finalProject/backend/api/order/user_orders.php', {
    credentials: 'include'
  })
  const data = await res.json()
  if (data.success) {
    orders.value = data.orders
    expanded.value = Array(data.orders.length).fill(false) // 預設全部收合
  } else {
    alert(data.message)
  }
})

const toggleDetails = (index) => {
  expanded.value[index] = !expanded.value[index]
}

const downloadInvoice = async (index) => {
  const orderID = orders.value[index].orderID
  const element = document.getElementById(`order-${orderID}`)
  if (!element) return

  // ✅ 展開明細以確保內容完整
  expanded.value[index] = true
  await nextTick()

  // ✅ 儲存原本樣式
  const originalColor = element.style.color
  const originalBg = element.style.backgroundColor

  // ✅ 臨時改為黑字白底
  element.style.color = '#000'
  element.style.backgroundColor = '#fff'

  // ✅ 擷取畫面
  html2canvas(element).then(canvas => {
    const imgData = canvas.toDataURL('image/png')
    const pdf = new jsPDF()
    const imgProps = pdf.getImageProperties(imgData)
    const pdfWidth = pdf.internal.pageSize.getWidth()
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width

    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight)
    pdf.save(`發票_${orderID}.pdf`)

    // ✅ 還原樣式
    element.style.color = originalColor
    element.style.backgroundColor = originalBg
  })
}

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
  position: relative;
}

.order-header p {
  margin: 0.3rem 0;
}

.toggle-btn {
  margin-top: 1rem;
  background-color: #00bcd4;
  color: white;
  border: none;
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}

.toggle-btn:hover {
  background-color: #0097a7;
}

.item-list {
  margin-top: 1rem;
  padding-left: 1.5rem;
}

.item {
  margin-bottom: 0.5rem;
  color: #ffe082;
}

.download-btn {
  margin-left: 1rem;
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}


.download-btn:hover {
  background-color: #388e3c;
}

</style>
