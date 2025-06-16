<template>
  <table>
    <thead>
      <tr>
        <th>商品名稱</th>
        <th>價格</th>
        <th>描述</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in products" :key="item.id">
        <td>{{ item.name }}</td>
        <td>${{ item.price }}</td>
        <td>{{ item.description }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
defineProps({
  products: {
    type: Array,
    required: true
  }
});
</script>
