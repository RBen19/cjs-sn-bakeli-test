<template>
  <span
    :class="[
      'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
      statut === 'actif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500',
    ]"
  >
    {{ statut === 'actif' ? 'Actif' : 'Inactif' }}
  </span>
</template>

<script setup>
defineProps({ statut: { type: String, required: true } })
</script>
