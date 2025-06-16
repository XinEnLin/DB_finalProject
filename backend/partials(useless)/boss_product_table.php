<?php
// $products 已由 boss_dashboard.php 傳入
?>

<h2>📦 boss商品列表</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>圖片</th><th>名稱</th><th>描述</th><th>價格</th><th>庫存</th><th>分類</th><th>操作</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><img src="../asset/images/<?php echo htmlspecialchars($product['imagePath']); ?>" height="80"></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['description']); ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['stock']; ?></td>
            <td><?php echo htmlspecialchars($product['category']); ?></td>
            <td>
                <form method="get" action="../layouts/admin_layout.php" style="display:inline;">
                    <input type="hidden" name="edit" value="<?php echo $product['productID']; ?>">
                    <button type="submit">✏️ 編輯</button>
                </form>
                <form method="post" action="../layouts/admin_layout.php" style="display:inline;" onsubmit="return confirm('確定要刪除？');">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                    <button type="submit">❌ 刪除</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
