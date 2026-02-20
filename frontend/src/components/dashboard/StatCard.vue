<script setup>
defineProps({
  title: { type: String, required: true },
  value: { type: [String, Number], required: true },
  icon: { type: String, required: true },
  color: { type: String, default: 'green' },
  trend: { type: String, default: '' },
})
</script>

<template>
  <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition-shadow">
    <div class="flex items-start justify-between mb-4">
      <div
        :class="[
          'w-12 h-12 rounded-xl flex items-center justify-center',
          color === 'green' ? 'bg-green-100' :
          color === 'blue' ? 'bg-blue-100' :
          color === 'red' ? 'bg-red-100' :
          color === 'yellow' ? 'bg-yellow-100' : 'bg-gray-100'
        ]"
      >
        <svg
          class="w-6 h-6"
          :class="[
            color === 'green' ? 'text-green-600' :
            color === 'blue' ? 'text-blue-600' :
            color === 'red' ? 'text-red-600' :
            color === 'yellow' ? 'text-yellow-600' : 'text-gray-600'
          ]"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          v-html="icon"
        ></svg>
      </div>
    </div>
    <div class="text-3xl font-bold text-gray-900 mb-1">{{ value }}</div>
    <div class="text-sm text-gray-500">{{ title }}</div>
  </div>
</template>
