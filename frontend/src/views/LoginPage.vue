<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import logo from '../assets/logo.png'

const router = useRouter()
const authStore = useAuthStore()

const form = reactive({ email: '', password: '', remember: false })
const loading = ref(false)
const error = ref('')

async function handleLogin() {
  loading.value = true
  error.value = ''
  try {
    await authStore.login({ email: form.email, password: form.password })
    router.push('/dashboard')
  } catch (err) {
    error.value = err.response?.data?.message || 'Email ou mot de passe incorrect.'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-green-50 to-white flex flex-col">
    <!-- Back link -->
    <div class="p-6">
      <RouterLink to="/" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour à l'accueil
      </RouterLink>
    </div>

    <!-- Card -->
    <div class="flex-1 flex items-center justify-center px-4 pb-12">
      <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-8">
        <!-- Logo -->
        <div class="text-center mb-6">
          <img :src="logo" alt="CSJ Logo" class="h-14 w-14 object-contain mx-auto mb-4" />
          <h1 class="text-2xl font-bold text-gray-900">Connexion</h1>
          <p class="text-sm text-gray-500 mt-1">Accédez à votre espace Consortium Jeunesse Sénégal</p>
        </div>

        <!-- Error -->
        <div v-if="error" class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg">
          {{ error }}
        </div>

        <form @submit.prevent="handleLogin" class="space-y-4">
          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Adresse email</label>
            <div class="relative">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <input
                v-model="form.email"
                type="email"
                required
                placeholder="votre.email@exemple.sn"
                class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent focus:bg-white"
              />
            </div>
          </div>

          <!-- Password -->
          <div>
            <div class="flex items-center justify-between mb-1.5">
              <label class="text-sm font-medium text-gray-700">Mot de passe</label>
              <a href="#" class="text-xs text-green-600 hover:text-green-700">Mot de passe oublié ?</a>
            </div>
            <div class="relative">
              <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
              <input
                v-model="form.password"
                type="password"
                required
                placeholder="••••••••"
                class="w-full pl-10 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent focus:bg-white"
              />
            </div>
          </div>

          <!-- Remember me -->
          <label class="flex items-center gap-2 cursor-pointer">
            <input v-model="form.remember" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-green-600" />
            <span class="text-sm text-gray-600">Se souvenir de moi</span>
          </label>

          <!-- Submit -->
          <button
            type="submit"
            :disabled="loading"
            class="w-full py-2.5 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors disabled:opacity-60 flex items-center justify-center gap-2"
          >
            <svg v-if="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            Se connecter
          </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-5">
          Vous n'avez pas de compte ?
          <RouterLink to="/inscription" class="text-green-600 font-medium hover:text-green-700">Inscrivez-vous</RouterLink>
        </p>

        <p class="text-center text-xs text-gray-400 mt-4 border-t border-gray-100 pt-4">
          Pour tester, utilisez n'importe quelle adresse email et mot de passe
        </p>
      </div>
    </div>
  </div>
</template>
