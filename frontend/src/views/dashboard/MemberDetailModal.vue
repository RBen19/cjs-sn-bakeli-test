<script setup>
import Avatar from '../../components/ui/Avatar.vue'
import Badge from '../../components/ui/Badge.vue'

const props = defineProps({
  show: { type: Boolean, default: false },
  membre: { type: Object, default: null },
})
const emit = defineEmits(['close', 'edit'])

function formatDate(dateStr) {
  if (!dateStr) return '—'
  return new Date(dateStr).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' })
}
</script>

<template>
  <Teleport to="body">
    <Transition enter-active-class="transition-opacity duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition-opacity duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="show && membre" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60" @click="emit('close')"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto" @click.stop>
          <!-- Header -->
          <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 sticky top-0 bg-white">
            <h3 class="text-lg font-semibold text-gray-900">Détails du membre</h3>
            <button class="text-gray-400 hover:text-gray-600" @click="emit('close')">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          <div class="px-6 py-5">
            <!-- Avatar + Name -->
            <div class="flex items-center gap-4 mb-5">
              <Avatar :prenom="membre.prenom" :nom="membre.nom" size="lg" />
              <div>
                <h4 class="text-xl font-bold text-gray-900">{{ membre.prenom }} {{ membre.nom }}</h4>
                <Badge :statut="membre.statut" class="mt-1" />
              </div>
            </div>

            <hr class="border-gray-100 mb-5" />

            <!-- Informations de contact -->
            <div class="mb-5">
              <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-800">Informations de contact</span>
              </div>
              <div class="space-y-3 pl-6">
                <div class="flex items-start gap-3">
                  <svg class="w-4 h-4 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                  <div>
                    <div class="text-xs text-gray-400">Email</div>
                    <div class="text-sm text-gray-800">{{ membre.email }}</div>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <svg class="w-4 h-4 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                  <div>
                    <div class="text-xs text-gray-400">Téléphone</div>
                    <div class="text-sm text-gray-800">{{ membre.telephone || '—' }}</div>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <svg class="w-4 h-4 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                  <div>
                    <div class="text-xs text-gray-400">Ville</div>
                    <div class="text-sm text-gray-800">{{ membre.ville || '—' }}</div>
                  </div>
                </div>
              </div>
            </div>

            <hr class="border-gray-100 mb-5" />

            <!-- Informations personnelles -->
            <div class="mb-5">
              <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-800">Informations personnelles</span>
              </div>
              <div class="space-y-3 pl-6">
                <div>
                  <div class="text-xs text-gray-400">Date de naissance</div>
                  <div class="text-sm text-gray-800">
                    {{ formatDate(membre.date_naissance) }}
                    <span v-if="membre.age" class="text-gray-400">({{ membre.age }} ans)</span>
                  </div>
                </div>
                <div>
                  <div class="text-xs text-gray-400">Date d'inscription</div>
                  <div class="text-sm text-gray-800">{{ formatDate(membre.created_at) }}</div>
                </div>
              </div>
            </div>

            <hr class="border-gray-100 mb-5" />

            <!-- Compétences -->
            <div class="mb-6">
              <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm font-semibold text-gray-800">Compétences</span>
              </div>
              <div class="pl-6 text-sm text-gray-700">{{ membre.competences || '—' }}</div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
              <button class="flex-1 py-2.5 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors" @click="emit('close')">
                Fermer
              </button>
              <button class="flex-1 py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2" @click="emit('edit', membre)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Modifier
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>
