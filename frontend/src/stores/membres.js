import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '../services/api'

export const useMembresStore = defineStore('membres', () => {
  const membres = ref([])
  const stats = ref({ total: 0, actifs: 0, inactifs: 0, villes_count: 0 })
  const loading = ref(false)
  const search = ref('')
  const filter = ref('')
  const currentPage = ref(1)
  const totalPages = ref(1)
  const total = ref(0)

  async function fetchMembres(page = 1) {
    loading.value = true
    try {
      const params = { page }
      if (search.value) params.search = search.value
      if (filter.value) params.statut = filter.value

      const response = await api.get('/membres', { params })
      membres.value = response.data.data
      currentPage.value = response.data.current_page
      totalPages.value = response.data.last_page
      total.value = response.data.total
    } finally {
      loading.value = false
    }
  }

  async function fetchStats() {
    const response = await api.get('/membres/stats')
    stats.value = response.data
  }

  async function createMembre(data) {
    const response = await api.post('/membres', data)
    await fetchMembres(currentPage.value)
    await fetchStats()
    return response.data
  }

  async function updateMembre(id, data) {
    const response = await api.put(`/membres/${id}`, data)
    await fetchMembres(currentPage.value)
    await fetchStats()
    return response.data
  }

  async function deleteMembre(id) {
    await api.delete(`/membres/${id}`)
    await fetchMembres(currentPage.value)
    await fetchStats()
  }

  async function getMembre(id) {
    const response = await api.get(`/membres/${id}`)
    return response.data
  }

  function setSearch(value) {
    search.value = value
    currentPage.value = 1
    fetchMembres(1)
  }

  function setFilter(value) {
    filter.value = value
    currentPage.value = 1
    fetchMembres(1)
  }

  return {
    membres,
    stats,
    loading,
    search,
    filter,
    currentPage,
    totalPages,
    total,
    fetchMembres,
    fetchStats,
    createMembre,
    updateMembre,
    deleteMembre,
    getMembre,
    setSearch,
    setFilter,
  }
})
