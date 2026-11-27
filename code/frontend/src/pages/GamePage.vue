<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import GameBoard from '@/components/game/GameBoard.vue'

const route = useRoute()
const gameId = route.params.id

// Estado temporário simulado da partida
const currentTurn = ref('white') // 'white' ou 'black'
const playerWhite = ref({ name: 'Maria Silva', rating: 1250, captured: 0, time: '05:00' })
const playerBlack = ref({ name: 'João Santos', rating: 1180, captured: 0, time: '04:45' })

// Funções simuladas para ações de jogo
const resign = () => {
  if (confirm('Tens a certeza de que queres desistir da partida?')) {
    alert('Desististe do jogo.')
  }
}

const offerDraw = () => {
  alert('Proposta de empate enviada ao oponente.')
}
</script>

<template>
  <div class="max-w-5xl mx-auto space-y-6">
    <!-- Cabeçalho Superior da Partida -->
    <div class="flex flex-wrap items-center justify-between gap-4 bg-white p-4 rounded-xl border shadow-sm">
      <div class="flex items-center space-x-3">
        <span class="px-3 py-1 bg-amber-100 text-amber-900 font-bold rounded-lg text-sm">
          Partida #{{ gameId }}
        </span>
        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800">
          Em Direto
        </span>
      </div>

      <!-- Indicador Central de Turno -->
      <div class="flex items-center space-x-2 px-4 py-1.5 rounded-full border bg-slate-50">
        <span class="text-xs font-medium text-slate-500">Turno Atual:</span>
        <span 
          class="text-xs font-bold px-2 py-0.5 rounded uppercase tracking-wider"
          :class="currentTurn === 'white' ? 'bg-slate-200 text-slate-800' : 'bg-slate-900 text-white'"
        >
          {{ currentTurn === 'white' ? 'Peças Brancas' : 'Peças Pretas' }}
        </span>
      </div>

      <RouterLink 
        to="/lobby" 
        class="text-xs font-medium text-slate-600 hover:text-slate-900 flex items-center space-x-1"
      >
        <span>← Voltar ao Lobby</span>
      </RouterLink>
    </div>

    <!-- Área Principal: Tabuleiro e Cartões dos Jogadores -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
      
      <!-- Painel Esquerdo: Jogador das Pretas (Oponente) -->
      <div class="lg:col-span-1 bg-white p-4 rounded-xl border shadow-sm space-y-4">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm">
            P
          </div>
          <div>
            <h3 class="font-bold text-sm text-slate-800">{{ playerBlack.name }}</h3>
            <p class="text-xs text-slate-400">Rating: {{ playerBlack.rating }} pts</p>
          </div>
        </div>

        <div class="flex items-center justify-between text-xs pt-2 border-t text-slate-600">
          <span>Tempo Restante:</span>
          <span class="font-mono font-bold text-slate-800 bg-slate-100 px-2 py-1 rounded">
            {{ playerBlack.time }}
          </span>
        </div>

        <div class="flex items-center justify-between text-xs text-slate-600">
          <span>Peças Capturadas:</span>
          <span class="font-bold text-slate-800">{{ playerBlack.captured }} / 12</span>
        </div>
      </div>

      <!-- Centro: O Tabuleiro de Damas 8x8 -->
      <div class="lg:col-span-2 flex justify-center">
        <GameBoard />
      </div>

      <!-- Painel Direito: Jogador das Brancas (Utilizador Atual) + Ações -->
      <div class="lg:col-span-1 bg-white p-4 rounded-xl border shadow-sm space-y-4">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-slate-100 border-2 border-slate-300 text-slate-800 flex items-center justify-center font-bold text-sm">
            B
          </div>
          <div>
            <h3 class="font-bold text-sm text-slate-800">{{ playerWhite.name }}</h3>
            <p class="text-xs text-slate-400">Rating: {{ playerWhite.rating }} pts</p>
          </div>
        </div>

        <div class="flex items-center justify-between text-xs pt-2 border-t text-slate-600">
          <span>Tempo Restante:</span>
          <span class="font-mono font-bold text-slate-800 bg-slate-100 px-2 py-1 rounded">
            {{ playerWhite.time }}
          </span>
        </div>

        <div class="flex items-center justify-between text-xs text-slate-600">
          <span>Peças Capturadas:</span>
          <span class="font-bold text-slate-800">{{ playerWhite.captured }} / 12</span>
        </div>

        <!-- Botões de Ação na Partida -->
        <div class="pt-4 border-t space-y-2">
          <button 
            @click="offerDraw"
            class="w-full py-1.5 text-xs font-semibold rounded bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors"
          >
            Oferecer Empate
          </button>
          <button 
            @click="resign"
            class="w-full py-1.5 text-xs font-semibold rounded bg-rose-50 hover:bg-rose-100 text-rose-700 transition-colors"
          >
            Desistir
          </button>
        </div>
      </div>

    </div>
  </div>
</template>