<script setup>
defineProps({
  modelValue: { type: String, default: '' },
})
const emit = defineEmits(['update:modelValue'])
</script>

<template>
  <select
    :value="modelValue"
    class="px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 bg-white text-gray-700"
    @change="emit('update:modelValue', $event.target.value)"
  >
    <option value="">Tous les membres</option>
    <option value="actif">Actifs</option>
    <option value="inactif">Inactifs</option>
  </select>
</template>
