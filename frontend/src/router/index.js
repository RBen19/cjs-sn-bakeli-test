import { createRouter, createWebHistory } from 'vue-router'
import LandingPage from '../views/LandingPage.vue'
import LoginPage from '../views/LoginPage.vue'
import RegisterPage from '../views/RegisterPage.vue'
import DashboardLayout from '../views/dashboard/DashboardLayout.vue'
import DashboardHome from '../views/dashboard/DashboardHome.vue'

const routes = [
  {
    path: '/',
    name: 'landing',
    component: LandingPage,
  },
  {
    path: '/connexion',
    name: 'login',
    component: LoginPage,
    meta: { guest: true },
  },
  {
    path: '/inscription',
    name: 'register',
    component: RegisterPage,
    meta: { guest: true },
  },
  {
    path: '/dashboard',
    component: DashboardLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'dashboard',
        component: DashboardHome,
      },
    ],
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/',
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('csj_token')

  if (to.meta.requiresAuth && !token) {
    return next('/connexion')
  }

  if (to.meta.guest && token) {
    return next('/dashboard')
  }

  next()
})

export default router
