<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// Dados simulados (Mock Data) para testar a interface do Salão
const games = ref([
  {
    id: 1,
    player1: 'Maria Silva',
    player2: null,
    type: 'Casual',
    status: 'Waiting',
    entryFee: 0
  },
  {
    id: 2,
    player1: 'João Santos',
    player2: null,
    type: 'Competitivo',
    status: 'Waiting',
    entryFee: 5
  },
  {
    id: 3,
    player1: 'Ana Costa',
    player2: 'Rui Oliveira',
    type: 'Competitivo',
    status: 'Playing',
    entryFee: 10
  }
])

// Função para navegar para a página do jogo específico
const joinGame = (gameId) => {
  router.push(`/game/${gameId}`)
}

// Função simulada para criar uma nova partida
const createGame = () => {
  const newId = games.value.length + 1
  router.push(`/game/${newId}`)
}
</script>

<template>
  <div class="space-y-6">
    <!-- Cabeçalho do Salão -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold tracking-tight">Salão de Jogos</h1>
        <p class="text-sm text-slate-500">
          Encontra uma partida aberta ou cria o teu próprio jogo de Damas.
        </p>
      </div>
      
      <button 
        @click="createGame"
        class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white font-medium rounded-lg shadow transition-colors"
      >
        + Criar Jogo
      </button>
    </div>

    <!-- Lista de Jogos (Cartões) -->
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
      <div 
        v-for="game in games" 
        :key="game.id"
        class="border rounded-xl p-5 bg-white shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between"
      >
        <div class="space-y-2">
          <div class="flex justify-between items-center">
            <span 
              class="text-xs font-semibold px-2.5 py-0.5 rounded-full"
              :class="game.type === 'Competitivo' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800'"
            >
              {{ game.type }}
            </span>
            <span class="text-xs text-slate-400">Jogo #{{ game.id }}</span>
          </div>

          <div class="pt-2">
            <p class="text-sm font-semibold text-slate-700">
              Jogador 1: <span class="font-normal">{{ game.player1 }}</span>
            </p>
            <p class="text-sm font-semibold text-slate-700">
              Jogador 2: 
              <span class="font-normal" :class="!game.player2 ? 'text-amber-600 italic' : ''">
                {{ game.player2 || 'À espera de oponente...' }}
              </span>
            </p>
          </div>
        </div>

        <div class="mt-4 pt-3 border-t flex items-center justify-between">
          <span class="text-xs text-slate-500">
            Aposta: <strong class="text-slate-800">{{ game.entryFee }} moedas</strong>
          </span>
          
          <button 
            @click="joinGame(game.id)"
            class="px-3 py-1.5 text-xs font-semibold rounded text-white transition-colors"
            :class="game.status === 'Waiting' ? 'bg-emerald-600 hover:bg-emerald-500' : 'bg-slate-600 hover:bg-slate-500'"
          >
            {{ game.status === 'Waiting' ? 'Entrar no Jogo' : 'Assistir' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>