<script setup>
import Sidebar from '../../components/dashboard/Sidebar.vue'
</script>

<template>
  <div class="flex min-h-screen bg-gray-50">
    <Sidebar />
    <div class="flex-1 min-w-0 overflow-hidden">
      <RouterView />
    </div>
  </div>
</template>
