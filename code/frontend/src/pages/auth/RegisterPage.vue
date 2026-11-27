<script setup>
import { ref } from 'vue'
import { useRouter, RouterLink } from 'vue-router'

const router = useRouter()
const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')

const handleRegister = () => {
  // Simulação temporária até ligarmos à API Laravel
  alert('Conta criada com sucesso! Podes agora efetuar o login.')
  router.push('/login')
}
</script>

<template>
  <div class="max-w-md mx-auto my-8 bg-white p-8 rounded-xl border shadow-sm space-y-6">
    <div class="space-y-2 text-center">
      <h1 class="text-2xl font-bold tracking-tight text-slate-800">Criar Conta de Jogador</h1>
      <p class="text-sm text-slate-500">
        Regista-te para jogares partidas competitivas e gerires a tua carteira.
      </p>
    </div>

    <form @submit.prevent="handleRegister" class="space-y-4">
      <div class="space-y-1">
        <label class="text-xs font-semibold text-slate-700">Nome de Utilizador</label>
        <input 
          v-model="name"
          type="text" 
          required
          placeholder="Ex: Maria Silva"
          class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
        />
      </div>

      <div class="space-y-1">
        <label class="text-xs font-semibold text-slate-700">Endereço de Email</label>
        <input 
          v-model="email"
          type="email" 
          required
          placeholder="exemplo@email.com"
          class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
        />
      </div>

      <div class="space-y-1">
        <label class="text-xs font-semibold text-slate-700">Palavra-passe</label>
        <input 
          v-model="password"
          type="password" 
          required
          placeholder="••••••••"
          class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
        />
      </div>

      <div class="space-y-1">
        <label class="text-xs font-semibold text-slate-700">Confirmar Palavra-passe</label>
        <input 
          v-model="passwordConfirmation"
          type="password" 
          required
          placeholder="••••••••"
          class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
        />
      </div>

      <button 
        type="submit"
        class="w-full py-2.5 bg-amber-600 hover:bg-amber-500 text-white font-semibold text-sm rounded-lg shadow transition-colors"
      >
        Registar Conta
      </button>
    </form>

    <div class="text-center text-xs text-slate-500 pt-4 border-t">
      Já tens conta? 
      <RouterLink to="/login" class="text-amber-600 font-semibold hover:underline">
        Entrar na conta
      </RouterLink>
    </div>
  </div>
</template>