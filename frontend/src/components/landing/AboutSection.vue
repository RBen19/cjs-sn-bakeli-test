<script setup>
import aboutPhoto from '../../assets/about-photo.png'
</script>

<template>
  <section id="about" class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <!-- Left: Photo -->
        <div>
          <img
            :src="aboutPhoto"
            alt="À propos du Consortium"
            class="w-full h-[420px] object-cover rounded-2xl shadow-md"
          />
        </div>

        <!-- Right: Content -->
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">À propos du Consortium</h2>
          <p class="text-gray-500 text-sm leading-relaxed mb-4">
            Le Consortium Jeunesse Sénégal est une initiative dédiée à
            l'épanouissement et au développement des compétences des jeunes
            sénégalais. Notre plateforme digitale facilite la gestion, le suivi et
            l'accompagnement de nos membres.
          </p>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Nous croyons en la puissance de la jeunesse sénégalaise et nous nous
            engageons à fournir les outils et les ressources nécessaires pour
            transformer les ambitions en réalité.
          </p>

          <ul class="space-y-3">
            <li class="flex items-center gap-3 text-sm text-gray-700">
              <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Plateforme 100% sécurisée et confidentielle
            </li>
            <li class="flex items-center gap-3 text-sm text-gray-700">
              <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Interface intuitive et facile à utiliser
            </li>
            <li class="flex items-center gap-3 text-sm text-gray-700">
              <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Support technique disponible 24/7
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>
