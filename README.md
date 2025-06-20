# 超讚小店專案

## 專案簡介

本專案為一個整合 **PHP + SQL Server + Session** 後端與 **Vue 3 + Vite** 前端的購物系統，支援商品瀏覽、購物車管理、登入驗證、訂單管理、管理者後台、PDF 發票下載等功能。

---

##  專案目錄結構

```plaintext
DB_FinalProject/
├── backend/                      # PHP 後端 API 與邏輯
│   ├── api/                      # API 端點（供前端呼叫）
│   │   ├── auth/                 # 使用者驗證 API
│   │   │   ├── login.php
│   │   │   ├── logout.php
│   │   │   └── register.php
│   │   ├── cart/                 # 購物車相關 API
│   │   │   ├── add_cart.php
│   │   │   ├── checkout_cart.php
│   │   │   ├── clear_cart.php
│   │   │   ├── delete_cart.php
│   │   │   ├── list_cart.php
│   │   │   └── update_cart.php
│   │   ├── order/                # 訂單相關 API
│   │   │   ├── boss_orders.php
│   │   │   ├── update_order_status.php
│   │   │   └── user_orders.php
│   │   └── products/             # 商品上傳 API（略）
│
│   ├── config/                   # 設定檔
│   │   └── db.php                # 資料庫連線設定
│
│   ├── controllers/             # 控制器（整理邏輯流程）
│   │   ├── CartController.php
│   │   ├── OrderController.php
│   │   └── ProductController.php
│
│   └── models/                  # 資料操作模型
│       ├── Cart.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Product.php
│       └── User.php
│
├── frontend/                    # Vue 前端應用
│   ├── public/                  # 公共資源
│   │   ├── images/              # 靜態圖片資源
│   │   └── icons/               # 網站 favicon、圖示等
│
│   ├── src/
│   │   ├── assets/              # CSS、圖片等資源
│   │   ├── components/          # 可重用元件（目前為空）
│   │   ├── router/              # Vue Router 設定
│   │   │   └── index.js
│   │   ├── views/               # 各頁面元件
│   │   │   ├── Cart.vue
│   │   │   ├── Login.vue
│   │   │   ├── ManageOrders.vue
│   │   │   ├── ManageProducts.vue
│   │   │   ├── Order.vue
│   │   │   ├── ProductList.vue
│   │   │   └── Register.vue
│   │   ├── App.vue              # 頁面主框架
│   │   └── main.js              # Vue app 入口
│
│   ├── package.json             # npm 相依與啟動腳本
│   └── vite.config.js           # Vite 設定
│
├── .gitignore
├── package-lock.json
├── README.md                    # 說明文件

```

---

## 功能模組說明
| 模組             | 技術         | 說明                                     |
|------------------|--------------|------------------------------------------|
| 登入 / 註冊系統  | PHP + Session | 支援帳號登入驗證、身份權限控管           |
| 商品瀏覽         | Vue 前端     | Vue Router 管理路由，商品以卡片方式展示 |
| 購物車功能       | Session + API | 可加入、修改數量、刪除、結帳             |
| 訂單記錄         | Vue + API    | 支援顧客查看訂單，管理者更新出貨狀態     |
| 管理後台         | Vue + API    | 管理商品（CRUD）與訂單狀態變更           |
| PDF 發票下載     | jsPDF        | 由使用者端渲染訂單內容並下載為 PDF        |
| 畫面切換動畫     | CSS + Vue    | 使用 `<transition>` 實現淡入淡出效果     |

---

##  開發日誌

| 日期        | 項目                       | 備註                           |
|-------------|----------------------------|--------------------------------|
| 2025/05/10  | 建立 `index.php` 商品清單頁 | 從資料庫撈資料，顯示卡片樣式 |
| 2025/05/11  | 完成加入購物車功能         | 使用 `$_SESSION['cart']` 儲存 |
| 2025/05/12  | 新增 `list_cart.php`        | 可顯示、刪除購物車項目       |
| 2025/05/12  | 重構商品管理為模組化架構   | 拆分 `add`, `edit`, `list`    |
| 2025/05/13  | 修正購物車移除失效問題     | 確認 `productID` 傳遞與型別   |
| 2025/05/14  | 使用者、商品、後臺管理、購物車大致寫好，接下來開始美化，目前有點卡住     |    |
| 2025/05/16  | 購物車有bug     |    |
| 2025/05/19  | 加入購物車有fatal error
| 2025/05/21  | 加入購物車成功，購物車還有bug
| 2025/06/15  | 完成基本 Vue Router 架構          | 支援路由與登入後導向             |
| 2025/06/16  | 串接 API 顯示商品與加入購物車     | 商品卡片元件 + Vue ref 設定     |
| 2025/06/17  | 購物車邏輯完成                     | 增加 / 刪除 / 清空 / 結帳       |
| 2025/06/18  | 訂單頁面完成 + 收合明細切換        | 展開/收合列表 + 美化樣式        |
| 2025/06/19  | 加入發票 PDF 下載                  | 使用 html2canvas + jsPDF         |
| 2025/06/20  | 全站加入轉場動畫與 header 導覽     | `<transition>` + scoped CSS     |

---



##  使用方式

1. 安裝環境：需有 Apache + PHP + SQL Server
2. 前端建置：
   ```bash
   cd frontend
   npm install
   npm run dev -- --host
3. 匯入後端資料庫（database.sql）

4. 瀏覽前端：http://localhost:5173/

---

## ? 開發者備註

- 資料使用 `$_SESSION` 管理購物車狀態
- 資料表結構與種子資料建議另外備份成 `database.sql`
- 可搭配 JavaScript 增加前端互動性

