import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter)

import CategoriesPage from '../pages/CategoriesPage'
import CategoryProductsPage from '../pages/CategoryProductsPage'
import CartPage from '../pages/CartPage'
import ProfilePage from '../pages/ProfilePage'

const Component404 = { template: '<div>Страница не найдена</div>'}

const routes = [
    { path: '*', component: Component404 },
    { path: '/', component: CategoriesPage },
    { path: '/category/:id', component: CategoryProductsPage },
    { path: '/cart', component: CartPage },
    { path: '/profile', component: ProfilePage }
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })
  
  export default router