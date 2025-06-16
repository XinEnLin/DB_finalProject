# 購物系統開發紀錄

## 專案簡介

本專案為一個以 PHP + SQL + Session 開發的簡易購物系統，支援商品瀏覽、購物車管理、登入驗證與後台商品管理功能。

---

##  專案目錄結構
ˋˋˋplaintext
? DB_FinalProject/
├── asset/
│   ├── css/
│   │   └── style.css
│   ├── images/
│   └── js/
│       └── main.js
├── config/
│   └── db.php                      # 資料庫連線設定
├── layouts/                        # 頁面框架與佈局
│   └── （可建立 admin_layout.php / index_layout.php）
├── public/                         # 前台與後台頁面入口
│   ├── boss_dashboard.php
│   ├── index.php
│   ├── list_cart.php
│   ├── list_product.php
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│   └── test.php
├── src/                            # 程式邏輯與資料處理類別
│   ├── Cart.php
│   ├── Order.php
│   ├── OrderItem.php
│   ├── Product.php
│   └── User.php
├── README.md
ˋˋˋ

---

## ? 功能模組說明

| 模組            | 說明                         |
|-----------------|------------------------------|
| `index.php`     | 顯示商品並可加入購物車       |
| `Cart.php`      | 管理購物車的加入與移除邏輯   |
| `list_cart.php` | 顯示購物車商品清單           |
| `boss_dashboard.php` | 管理商品的新增、編輯、刪除 |
| `Product.php`   | 負責商品的 CRUD 操作         |

---

## ? 開發日誌

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
---

## ? 待辦清單

 ? TODO 開發項目（2024-05-13）

- [ ] ? 檢查登出路由邏輯：
  - 登出目前使用 `index.php?action=logout`，透過 `User::logout()` 實作
  - 建議封裝為單獨 `logout.php` 檔案（可選）

- [ ] ?? 頁面提示訊息優化：
  - 註冊成功、登入成功應使用 `$_SESSION['message']` 統一處理顯示
  - 可抽出 `partials/message.php` 顯示一次後自動消失

- [ ] ? 加入購物車後 UI 反饋：
  - 可顯示「? 已加入購物車」訊息
  - 或將購物車數量顯示在頁面右上角

- [ ] ? 重構 session 結構與登入狀態檢查：
  - 建立 `User::isLoggedIn()` 方法已完成
  - 所有需登入頁面（如購物車、結帳、會員中心）需驗證登入狀態

- [ ] ? 登入後自動帶入使用者資料（email / 地址 / 電話）
  - 可透過 `$_SESSION['user']` 儲存完整資訊，減少查詢次數
  
- [ ]  boss mode下在首頁要可以回到dashboard


## ? 使用方式

1. 安裝 Apache + PHP + MySQL 環境（建議使用 XAMPP）
2. 將專案放入 `htdocs/` 目錄下
3. 匯入資料庫腳本（若有）
4. 進入首頁： [http://localhost/DB_finalProject/public/index.php](http://localhost/DB_finalProject/public/index.php)

---

## ? 開發者備註

- 資料使用 `$_SESSION` 管理購物車狀態
- 資料表結構與種子資料建議另外備份成 `database.sql`
- 可搭配 JavaScript 增加前端互動性

