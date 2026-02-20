<script setup>
import { ref, computed, onMounted } from 'vue'
import { useMembresStore } from '../../stores/membres'
import { useAuthStore } from '../../stores/auth'
import SearchBar from '../../components/dashboard/SearchBar.vue'
import MembresTable from '../../components/dashboard/MembresTable.vue'
import MemberAddModal from './MemberAddModal.vue'
import MemberEditModal from './MemberEditModal.vue'
import MemberDetailModal from './MemberDetailModal.vue'
import ConfirmDialog from '../../components/ui/ConfirmDialog.vue'

const membresStore = useMembresStore()
const authStore = useAuthStore()

const showAddModal = ref(false)
const showEditModal = ref(false)
const showDetailModal = ref(false)
const showDeleteDialog = ref(false)
const selectedMembre = ref(null)
const membreToDelete = ref(null)

const toast = ref({ show: false, message: '', type: 'success' })

const searchValue = computed({
  get: () => membresStore.search,
  set: (val) => membresStore.setSearch(val),
})

const filterValue = computed({
  get: () => membresStore.filter,
  set: (val) => membresStore.setFilter(val),
})

onMounted(async () => {
  await Promise.all([membresStore.fetchMembres(), membresStore.fetchStats()])
})

function showToast(message, type = 'success') {
  toast.value = { show: true, message, type }
  setTimeout(() => { toast.value.show = false }, 3000)
}

function handleView(membre) {
  selectedMembre.value = membre
  showDetailModal.value = true
}

function handleEdit(membre) {
  selectedMembre.value = membre
  showDetailModal.value = false
  showEditModal.value = true
}

function handleDelete(membre) {
  membreToDelete.value = membre
  showDeleteDialog.value = true
}

async function confirmDelete() {
  try {
    await membresStore.deleteMembre(membreToDelete.value.id)
    showToast('Membre supprimé avec succès !')
  } catch {
    showToast('Erreur lors de la suppression.', 'error')
  } finally {
    showDeleteDialog.value = false
    membreToDelete.value = null
  }
}
</script>

<template>
  <div class="flex-1 flex flex-col min-h-screen bg-gray-50">
    <!-- Toast -->
    <Transition
      enter-active-class="transition-all duration-300"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition-all duration-200"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="toast.show"
        class="fixed top-5 right-5 z-50 flex items-center gap-2 px-4 py-3 rounded-lg shadow-lg text-sm font-medium"
        :class="toast.type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'"
      >
        <svg v-if="toast.type === 'success'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ toast.message }}
      </div>
    </Transition>

    <!-- Top header -->
    <div class="bg-white border-b border-gray-100 px-8 py-5 flex items-center justify-between">
      <div>
        <h1 class="text-xl font-bold text-gray-900">Tableau de bord</h1>
        <p class="text-sm text-gray-400 mt-0.5">Gestion des membres du Consortium Jeunesse Sénégal</p>
      </div>
      <span class="text-sm text-gray-500 font-medium">Utilisateur</span>
    </div>

    <div class="p-8">
      <!-- Stat cards -->
      <div class="grid grid-cols-4 gap-4 mb-8">
        <!-- Total membres -->
        <div class="bg-white rounded-xl border border-gray-100 p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-400 font-medium">Total Membres</span>
            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900">{{ membresStore.stats.total }}</div>
        </div>

        <!-- Membres actifs -->
        <div class="bg-white rounded-xl border border-gray-100 p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-400 font-medium">Membres Actifs</span>
            <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900">{{ membresStore.stats.actifs }}</div>
        </div>

        <!-- Membres inactifs -->
        <div class="bg-white rounded-xl border border-gray-100 p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-400 font-medium">Membres Inactifs</span>
            <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900">{{ membresStore.stats.inactifs }}</div>
        </div>

        <!-- Villes -->
        <div class="bg-white rounded-xl border border-gray-100 p-5">
          <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-400 font-medium">Villes Couvertes</span>
            <div class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
          </div>
          <div class="text-3xl font-bold text-gray-900">{{ membresStore.stats.villes_count }}</div>
        </div>
      </div>

      <!-- Table section -->
      <div class="bg-white rounded-xl border border-gray-100">
        <!-- Toolbar -->
        <div class="px-6 py-4 flex items-center gap-3">
          <SearchBar v-model="searchValue" class="flex-1" />
          <!-- Filter inline -->
          <div class="relative">
            <select
              :value="filterValue"
              class="appearance-none pl-8 pr-8 py-2.5 text-sm border border-gray-200 rounded-lg bg-white text-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 cursor-pointer"
              @change="filterValue = $event.target.value"
            >
              <option value="">Tous</option>
              <option value="actif">Actifs</option>
              <option value="inactif">Inactifs</option>
            </select>
            <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
            </svg>
            <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
          <button
            class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors whitespace-nowrap"
            @click="showAddModal = true"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau membre
          </button>
        </div>

        <MembresTable
          :membres="membresStore.membres"
          :loading="membresStore.loading"
          :current-page="membresStore.currentPage"
          :total-pages="membresStore.totalPages"
          :total="membresStore.total"
          @view="handleView"
          @edit="handleEdit"
          @delete="handleDelete"
          @page-change="membresStore.fetchMembres($event)"
        />
      </div>
    </div>

    <!-- Modals -->
    <MemberAddModal :show="showAddModal" @close="showAddModal = false" @success="showToast" />
    <MemberEditModal :show="showEditModal" :membre="selectedMembre" @close="showEditModal = false" @success="showToast" />
    <MemberDetailModal :show="showDetailModal" :membre="selectedMembre" @close="showDetailModal = false" @edit="handleEdit" />
    <ConfirmDialog
      :show="showDeleteDialog"
      :message="`Êtes-vous sûr de vouloir supprimer ce membre ? Cette action est irréversible.`"
      @confirm="confirmDelete"
      @cancel="showDeleteDialog = false"
    />
  </div>
</template>
