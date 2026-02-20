<script setup>
const props = defineProps({
  currentPage: { type: Number, required: true },
  totalPages: { type: Number, required: true },
  total: { type: Number, default: 0 },
})

const emit = defineEmits(['page-change'])

const pages = () => {
  const range = []
  const start = Math.max(1, props.currentPage - 2)
  const end = Math.min(props.totalPages, props.currentPage + 2)
  for (let i = start; i <= end; i++) {
    range.push(i)
  }
  return range
}
</script>

<template>
  <div v-if="totalPages > 1" class="flex items-center justify-between px-4 py-3 border-t border-gray-200">
    <div class="text-sm text-gray-500">
      Page {{ currentPage }} sur {{ totalPages }} ({{ total }} résultats)
    </div>
    <div class="flex gap-1">
      <button
        :disabled="currentPage === 1"
        class="px-3 py-1 text-sm rounded-lg border border-gray-300 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 transition-colors"
        @click="emit('page-change', currentPage - 1)"
      >
        ‹
      </button>
      <button
        v-for="page in pages()"
        :key="page"
        :class="[
          'px-3 py-1 text-sm rounded-lg border transition-colors',
          page === currentPage
            ? 'bg-green-600 text-white border-green-600'
            : 'border-gray-300 hover:bg-gray-50',
        ]"
        @click="emit('page-change', page)"
      >
        {{ page }}
      </button>
      <button
        :disabled="currentPage === totalPages"
        class="px-3 py-1 text-sm rounded-lg border border-gray-300 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 transition-colors"
        @click="emit('page-change', currentPage + 1)"
      >
        ›
      </button>
    </div>
  </div>
</template>
