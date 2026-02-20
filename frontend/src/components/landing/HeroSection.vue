<script setup>
import landingPhoto from '../../assets/landing-photo.png'
</script>

<template>
  <section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <!-- Left -->
        <div>
          <div class="inline-flex items-center gap-2 bg-green-50 text-green-700 border border-green-200 px-3 py-1 rounded-full text-xs font-medium mb-6">
            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
            Plateforme de Gestion de la Jeunesse
          </div>

          <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">
            Ensemble pour<br>
            l'épanouissement de la<br>
            <span class="text-gray-900">jeunesse sénégalaise</span>
          </h1>

          <p class="text-gray-500 text-base leading-relaxed mb-8">
            Une plateforme moderne pour gérer, suivre et accompagner les
            jeunes talents du Sénégal. Développez vos compétences, connectez-
            vous et construisez votre avenir.
          </p>

          <div class="flex items-center gap-4 mb-10">
            <RouterLink
              to="/inscription"
              class="px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors"
            >
              Commencer gratuitement →
            </RouterLink>
            <RouterLink
              to="/connexion"
              class="px-5 py-2.5 text-sm font-medium text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
            >
              Se connecter
            </RouterLink>
          </div>

          <!-- Stats -->
          <div class="flex items-center gap-8">
            <div>
              <div class="text-2xl font-bold text-gray-900">500+</div>
              <div class="text-xs text-gray-400 mt-0.5">Jeunes inscrits</div>
            </div>
            <div class="h-8 w-px bg-gray-200"></div>
            <div>
              <div class="text-2xl font-bold text-gray-900">50+</div>
              <div class="text-xs text-gray-400 mt-0.5">Programmes</div>
            </div>
            <div class="h-8 w-px bg-gray-200"></div>
            <div>
              <div class="text-2xl font-bold text-gray-900">98%</div>
              <div class="text-xs text-gray-400 mt-0.5">Satisfaction</div>
            </div>
          </div>
        </div>

        <!-- Right: Photo + floating badge -->
        <div class="relative">
          <img
            :src="landingPhoto"
            alt="Jeunesse sénégalaise"
            class="w-full h-[420px] object-cover rounded-2xl shadow-lg"
          />
          <!-- Floating badge -->
          <div class="absolute bottom-6 left-6 bg-white rounded-xl shadow-lg px-4 py-3 flex items-center gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
              </svg>
            </div>
            <div>
              <div class="text-xs text-gray-400">Croissance mensuelle</div>
              <div class="text-sm font-bold text-gray-900">+61%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
