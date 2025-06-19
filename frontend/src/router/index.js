import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import ProductList from '../views/ProductList.vue'
import Cart from '../views/Cart.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
// import BossDashboard from '../views/BossDashboard.vue'
import Order from '../views/Order.vue'
import ManageOrders from '../views/ManageOrders.vue'
import ManageProducts from '../views/ManageProducts.vue'

// 路由表
const routes = [
    { path: '/', component: Home },
    { path: '/products', component: ProductList },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/cart', component: Cart },
    // { path: '/boss', component: BossDashboard },
    { path: '/orders', component: Order },
    { path: '/manage-orders', component: ManageOrders },
    { path: '/manage-products', component: ManageProducts }
]

// 建立 router
const router = createRouter({
    history: createWebHistory(),
    routes
})

// 全域前置守衛：舉例，讓未登入用戶無法進入購物車
router.beforeEach(async(to, from, next) => {
    // 你可以自訂哪些路由需要登入
    const protectedPages = ['/cart', '/boss', '/orders', '/manage-orders', '/manage-products']
    if (protectedPages.includes(to.path)) {
        // 檢查 session 狀態
        const res = await fetch('/DB_finalProject/backend/api/auth/me.php', { credentials: 'include' })
        const data = await res.json()
        if (!data.loggedIn) {
            // 未登入導向 login
            return next('/login')
        }
    }
    // 其他頁面放行
    next()
})

export default router