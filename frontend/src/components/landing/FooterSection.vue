<script setup>
import logo from '../../assets/logo.png'
</script>

<template>
  <footer id="contact" class="bg-gray-900 text-gray-400 py-14">
    <div class="max-w-6xl mx-auto px-6">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-10 mb-10">
        <!-- Logo + desc -->
        <div class="col-span-2 md:col-span-1">
          <div class="flex items-center gap-2 mb-3">
            <img :src="logo" alt="Logo" class="h-8 w-8 object-contain" />
            <span class="text-white font-semibold text-sm">CSJ</span>
          </div>
          <p class="text-xs leading-relaxed text-gray-500">
            Consortium Jeunesse Sénégal - Ensemble pour l'avenir
          </p>
        </div>

        <!-- Liens rapides -->
        <div>
          <h4 class="text-white text-sm font-semibold mb-4">Liens rapides</h4>
          <ul class="space-y-2 text-xs">
            <li><a href="#fonctionnalites" class="hover:text-green-400 transition-colors">Fonctionnalités</a></li>
            <li><a href="#about" class="hover:text-green-400 transition-colors">À propos</a></li>
            <li><a href="#contact" class="hover:text-green-400 transition-colors">Contact</a></li>
          </ul>
        </div>

        <!-- Ressources -->
        <div>
          <h4 class="text-white text-sm font-semibold mb-4">Ressources</h4>
          <ul class="space-y-2 text-xs">
            <li><a href="#" class="hover:text-green-400 transition-colors">Documentation</a></li>
            <li><a href="#" class="hover:text-green-400 transition-colors">Support</a></li>
            <li><a href="#" class="hover:text-green-400 transition-colors">Blog</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div>
          <h4 class="text-white text-sm font-semibold mb-4">Contact</h4>
          <ul class="space-y-2 text-xs">
            <li>Dakar, Sénégal</li>
            <li>contact@csj.sn</li>
            <li>+221 33 123 45 67</li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-800 pt-6 text-center text-xs text-gray-600">
        &copy; {{ new Date().getFullYear() }} Consortium Jeunesse Sénégal. Tous droits réservés.
      </div>
    </div>
  </footer>
</template>
