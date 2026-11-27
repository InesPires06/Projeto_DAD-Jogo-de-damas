<script setup>
import { RouterLink } from 'vue-router'
import LoginForm from '@/components/auth/LoginForm.vue'
</script>

<template>
  <div class="max-w-md mx-auto my-8 bg-white p-8 rounded-xl border shadow-sm space-y-6">
    <div class="space-y-2 text-center">
      <h1 class="text-2xl font-bold tracking-tight text-slate-800">Entrar na Conta</h1>
      <p class="text-sm text-slate-500">
        Insere as tuas credenciais para acederes à plataforma de Damas.
      </p>
    </div>

    <!-- Utilização do componente LoginForm existente -->
    <LoginForm />

    <div class="text-center text-xs text-slate-500 pt-4 border-t">
      Ainda não tens conta? 
      <RouterLink to="/register" class="text-amber-600 font-semibold hover:underline">
        Registar novo jogador
      </RouterLink>
    </div>
  </div>
</template>