<script setup>
import { reactive, ref } from 'vue'
import { useMembresStore } from '../../stores/membres'

defineProps({ show: { type: Boolean, default: false } })
const emit = defineEmits(['close', 'success'])

const membresStore = useMembresStore()
const loading = ref(false)
const errors = ref({})

const form = reactive({
  prenom: '', nom: '', email: '', telephone: '',
  ville: '', date_naissance: '', competences: '', statut: 'actif',
})

function resetForm() {
  Object.assign(form, { prenom: '', nom: '', email: '', telephone: '', ville: '', date_naissance: '', competences: '', statut: 'actif' })
  errors.value = {}
}

async function handleSubmit() {
  loading.value = true
  errors.value = {}
  try {
    await membresStore.createMembre({ ...form })
    resetForm()
    emit('success', 'Membre ajouté avec succès !')
    emit('close')
  } catch (error) {
    if (error.response?.status === 422) errors.value = error.response.data.errors || {}
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <Teleport to="body">
    <Transition enter-active-class="transition-opacity duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition-opacity duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60" @click="emit('close')"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg" @click.stop>
          <!-- Header -->
          <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Nouveau membre</h3>
            <button class="text-gray-400 hover:text-gray-600 transition-colors" @click="emit('close')">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          <!-- Body -->
          <form @submit.prevent="handleSubmit" class="px-6 py-5">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                <input v-model="form.prenom" type="text" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
                <p v-if="errors.prenom" class="text-red-500 text-xs mt-1">{{ errors.prenom[0] }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                <input v-model="form.nom" type="text" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
                <p v-if="errors.nom" class="text-red-500 text-xs mt-1">{{ errors.nom[0] }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input v-model="form.email" type="email" required class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
                <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email[0] }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone *</label>
                <input v-model="form.telephone" type="text" placeholder="+221 77 123 45 67" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ville *</label>
                <input v-model="form.ville" type="text" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de naissance *</label>
                <input v-model="form.date_naissance" type="date" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Compétences *</label>
                <textarea
                  v-model="form.competences"
                  rows="3"
                  placeholder="Ex: Développement Web, React, Node.js"
                  class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white resize-none"
                ></textarea>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
                <select v-model="form.statut" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-green-500">
                  <option value="actif">Actif</option>
                  <option value="inactif">Inactif</option>
                </select>
              </div>
            </div>

            <!-- Footer -->
            <div class="flex gap-3 mt-6">
              <button type="button" class="flex-1 py-2.5 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors" @click="emit('close')">
                Annuler
              </button>
              <button type="submit" :disabled="loading" class="flex-1 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors disabled:opacity-60 flex items-center justify-center gap-2">
                <svg v-if="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Ajouter
              </button>
            </div>
          </form>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>
