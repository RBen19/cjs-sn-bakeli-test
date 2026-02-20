import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '../services/api'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(JSON.parse(localStorage.getItem('csj_user') || 'null'))
  const token = ref(localStorage.getItem('csj_token') || null)

  const isAuthenticated = computed(() => !!token.value)

  const userFullName = computed(() => {
    if (user.value) {
      return `${user.value.prenom} ${user.value.nom}`
    }
    return ''
  })

  async function login(credentials) {
    const response = await api.post('/auth/login', credentials)
    const { user: userData, token: userToken } = response.data

    user.value = userData
    token.value = userToken

    localStorage.setItem('csj_token', userToken)
    localStorage.setItem('csj_user', JSON.stringify(userData))

    return response.data
  }

  async function register(data) {
    const response = await api.post('/auth/register', data)
    const { user: userData, token: userToken } = response.data

    user.value = userData
    token.value = userToken

    localStorage.setItem('csj_token', userToken)
    localStorage.setItem('csj_user', JSON.stringify(userData))

    return response.data
  }

  async function logout() {
    try {
      await api.post('/auth/logout')
    } catch (error) {
      // ignore errors
    } finally {
      user.value = null
      token.value = null
      localStorage.removeItem('csj_token')
      localStorage.removeItem('csj_user')
    }
  }

  async function fetchUser() {
    try {
      const response = await api.get('/auth/me')
      user.value = response.data
      localStorage.setItem('csj_user', JSON.stringify(response.data))
      return response.data
    } catch (error) {
      user.value = null
      token.value = null
      localStorage.removeItem('csj_token')
      localStorage.removeItem('csj_user')
      throw error
    }
  }

  return {
    user,
    token,
    isAuthenticated,
    userFullName,
    login,
    register,
    logout,
    fetchUser,
  }
})
