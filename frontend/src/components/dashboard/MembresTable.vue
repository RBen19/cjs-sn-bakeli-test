<script setup>
import Avatar from '../ui/Avatar.vue'
import Badge from '../ui/Badge.vue'
import Pagination from '../ui/Pagination.vue'

defineProps({
  membres: { type: Array, default: () => [] },
  loading: { type: Boolean, default: false },
  currentPage: { type: Number, default: 1 },
  totalPages: { type: Number, default: 1 },
  total: { type: Number, default: 0 },
})
const emit = defineEmits(['view', 'edit', 'delete', 'page-change'])
</script>

<template>
  <div>
    <table class="w-full text-sm">
      <thead>
        <tr class="border-t border-gray-100">
          <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Membre</th>
          <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Contact</th>
          <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Ville</th>
          <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Compétences</th>
          <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Statut</th>
          <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="loading">
          <td colspan="6" class="px-6 py-16 text-center">
            <div class="flex items-center justify-center gap-2 text-gray-400">
              <svg class="w-5 h-5 animate-spin text-green-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              <span class="text-sm">Chargement...</span>
            </div>
          </td>
        </tr>

        <tr v-else-if="membres.length === 0">
          <td colspan="6" class="px-6 py-16 text-center text-gray-400 text-sm">
            Aucun membre trouvé
          </td>
        </tr>

        <tr
          v-for="membre in membres"
          :key="membre.id"
          class="border-t border-gray-50 hover:bg-gray-50 transition-colors"
        >
          <!-- Membre -->
          <td class="px-6 py-4">
            <div class="flex items-center gap-3">
              <Avatar :prenom="membre.prenom" :nom="membre.nom" size="md" />
              <span class="font-medium text-gray-800">{{ membre.prenom }} {{ membre.nom }}</span>
            </div>
          </td>

          <!-- Contact -->
          <td class="px-6 py-4">
            <div class="text-gray-700 text-xs">{{ membre.email }}</div>
            <div class="text-gray-400 text-xs mt-0.5">{{ membre.telephone || '—' }}</div>
          </td>

          <!-- Ville -->
          <td class="px-6 py-4 text-gray-600 text-sm">{{ membre.ville || '—' }}</td>

          <!-- Compétences -->
          <td class="px-6 py-4">
            <span class="text-gray-500 text-xs line-clamp-2 max-w-[180px] block">
              {{ membre.competences || '—' }}
            </span>
          </td>

          <!-- Statut -->
          <td class="px-6 py-4">
            <Badge :statut="membre.statut" />
          </td>

          <!-- Actions -->
          <td class="px-6 py-4">
            <div class="flex items-center gap-2">
              <button
                class="p-1.5 text-gray-400 hover:text-gray-600 transition-colors"
                title="Voir"
                @click="emit('view', membre)"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
              <button
                class="p-1.5 text-gray-400 hover:text-gray-600 transition-colors"
                title="Modifier"
                @click="emit('edit', membre)"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
              </button>
              <button
                class="p-1.5 text-red-400 hover:text-red-600 transition-colors"
                title="Supprimer"
                @click="emit('delete', membre)"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <Pagination
      :current-page="currentPage"
      :total-pages="totalPages"
      :total="total"
      @page-change="emit('page-change', $event)"
    />
  </div>
</template>
