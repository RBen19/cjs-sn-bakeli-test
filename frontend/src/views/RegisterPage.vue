<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import logo from '../assets/logo.png'

const router = useRouter()
const authStore = useAuthStore()

const form = reactive({ prenom: '', nom: '', email: '', password: '', password_confirmation: '', terms: false })
const loading = ref(false)
const errors = ref({})
const generalError = ref('')

async function handleRegister() {
  loading.value = true
  errors.value = {}
  generalError.value = ''
  if (!form.terms) {
    generalError.value = "Vous devez accepter les conditions d'utilisation."
    loading.value = false
    return
  }
  try {
    await authStore.register({
      prenom: form.prenom, nom: form.nom, email: form.email,
      password: form.password, password_confirmation: form.password_confirmation,
    })
    router.push('/dashboard')
  } catch (err) {
    if (err.response?.status === 422) errors.value = err.response.data.errors || {}
    else generalError.value = err.response?.data?.message || 'Une erreur est survenue.'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-green-50 to-white flex flex-col">
    <div class="p-6">
      <RouterLink to="/" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour à l'accueil
      </RouterLink>
    </div>

    <div class="flex-1 flex items-center justify-center px-4 pb-12">
      <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
          <img :src="logo" alt="CSJ Logo" class="h-14 w-14 object-contain mx-auto mb-4" />
          <h1 class="text-2xl font-bold text-gray-900">Inscription</h1>
          <p class="text-sm text-gray-500 mt-1">Rejoignez le Consortium Jeunesse Sénégal</p>
        </div>

        <div v-if="generalError" class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg">
          {{ generalError }}
        </div>

        <form @submit.prevent="handleRegister" class="space-y-4">
          <!-- Prénom + Nom -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Prénom</label>
              <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <input v-model="form.prenom" type="text" required placeholder="Amadou" class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
              </div>
              <p v-if="errors.prenom" class="text-red-500 text-xs mt-1">{{ errors.prenom[0] }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Nom</label>
              <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <input v-model="form.nom" type="text" required placeholder="Diop" class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
              </div>
              <p v-if="errors.nom" class="text-red-500 text-xs mt-1">{{ errors.nom[0] }}</p>
            </div>
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Adresse email</label>
            <div class="relative">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <input v-model="form.email" type="email" required placeholder="votre.email@exemple.sn" class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
            </div>
            <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email[0] }}</p>
          </div>

          <!-- Password -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Mot de passe</label>
            <div class="relative">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
              <input v-model="form.password" type="password" required placeholder="••••••••" class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
            </div>
            <p v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password[0] }}</p>
          </div>

          <!-- Confirm password -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirmer le mot de passe</label>
            <div class="relative">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
              <input v-model="form.password_confirmation" type="password" required placeholder="••••••••" class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white"/>
            </div>
          </div>

          <!-- Terms -->
          <label class="flex items-start gap-2.5 cursor-pointer">
            <input v-model="form.terms" type="checkbox" class="w-4 h-4 mt-0.5 rounded border-gray-300 text-green-600"/>
            <span class="text-xs text-gray-600">
              J'accepte les
              <a href="#" class="text-green-600 hover:underline">conditions d'utilisation</a>
              et la
              <a href="#" class="text-green-600 hover:underline">politique de confidentialité</a>
            </span>
          </label>

          <button
            type="submit"
            :disabled="loading"
            class="w-full py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors disabled:opacity-60 flex items-center justify-center gap-2"
          >
            <svg v-if="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            S'inscrire
          </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-5">
          Vous avez déjà un compte ?
          <RouterLink to="/connexion" class="text-green-600 font-medium hover:text-green-700">Connectez-vous</RouterLink>
        </p>
      </div>
    </div>
  </div>
</template>
