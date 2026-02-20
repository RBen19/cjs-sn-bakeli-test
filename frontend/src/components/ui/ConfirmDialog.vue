<script setup>
defineProps({
  show: { type: Boolean, default: false },
  title: { type: String, default: 'Confirmer la suppression' },
  message: { type: String, default: 'Êtes-vous sûr de vouloir supprimer ce membre ? Cette action est irréversible.' },
})
const emit = defineEmits(['confirm', 'cancel'])
</script>

<template>
  <Teleport to="body">
    <Transition enter-active-class="transition-opacity duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition-opacity duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-sm p-6" @click.stop>
          <h3 class="text-base font-semibold text-gray-900 mb-2">{{ title }}</h3>
          <p class="text-sm text-gray-500 mb-6">{{ message }}</p>
          <div class="flex gap-3">
            <button
              class="flex-1 py-2.5 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
              @click="emit('cancel')"
            >
              Annuler
            </button>
            <button
              class="flex-1 py-2.5 text-sm font-semibold text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors"
              @click="emit('confirm')"
            >
              Supprimer
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>
