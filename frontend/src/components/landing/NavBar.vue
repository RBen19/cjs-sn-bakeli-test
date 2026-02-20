<script setup>
import { ref } from 'vue'
import logo from '../../assets/logo.png'

const menuOpen = ref(false)
</script>

<template>
  <nav class="bg-white border-b border-gray-100 sticky top-0 z-40">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <RouterLink to="/" class="flex items-center gap-2">
          <img :src="logo" alt="CSJ Logo" class="h-9 w-9 object-contain" />
          <span class="font-semibold text-gray-800 text-sm">Consortium Jeunesse Sénégal</span>
        </RouterLink>

        <!-- Desktop links -->
        <div class="hidden md:flex items-center gap-8">
          <a href="#fonctionnalites" class="text-sm text-gray-600 hover:text-green-600 transition-colors">Fonctionnalités</a>
          <a href="#about" class="text-sm text-gray-600 hover:text-green-600 transition-colors">À propos</a>
          <a href="#contact" class="text-sm text-gray-600 hover:text-green-600 transition-colors">Contact</a>
        </div>

        <!-- Auth buttons -->
        <div class="hidden md:flex items-center gap-3">
          <RouterLink to="/connexion" class="text-sm text-gray-700 hover:text-green-600 font-medium transition-colors px-2">
            Connexion
          </RouterLink>
          <RouterLink to="/inscription" class="text-sm font-medium text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg transition-colors">
            Inscription
          </RouterLink>
        </div>

        <!-- Mobile burger -->
        <button class="md:hidden p-2" @click="menuOpen = !menuOpen">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="!menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <!-- Mobile menu -->
      <div v-if="menuOpen" class="md:hidden py-3 border-t border-gray-100 flex flex-col gap-3">
        <a href="#fonctionnalites" class="text-sm text-gray-600" @click="menuOpen=false">Fonctionnalités</a>
        <a href="#about" class="text-sm text-gray-600" @click="menuOpen=false">À propos</a>
        <a href="#contact" class="text-sm text-gray-600" @click="menuOpen=false">Contact</a>
        <RouterLink to="/connexion" class="text-sm text-gray-700 font-medium">Connexion</RouterLink>
        <RouterLink to="/inscription" class="text-sm font-medium text-white bg-green-600 px-4 py-2 rounded-lg text-center">Inscription</RouterLink>
      </div>
    </div>
  </nav>
</template>
