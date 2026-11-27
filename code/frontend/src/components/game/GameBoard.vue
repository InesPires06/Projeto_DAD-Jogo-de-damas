<script setup>
import { ref } from 'vue'

// O tabuleiro de Damas 8x8 tem 64 casas (0 a 63)
// Vamos criar uma representação visual simples do tabuleiro
// 0 = casa vazia, 1 = peão branco, 2 = peão preto

const boardState = ref([
  // Linha 0 (Pretas entram aqui no início)
  0, 2, 0, 2, 0, 2, 0, 2,
  // Linha 1
  2, 0, 2, 0, 2, 0, 2, 0,
  // Linha 2
  0, 2, 0, 2, 0, 2, 0, 2,
  // Linhas 3 e 4 (Vazias no início do jogo)
  0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0,
  // Linha 5 (Brancas)
  1, 0, 1, 0, 1, 0, 1, 0,
  // Linha 6
  0, 1, 0, 1, 0, 1, 0, 1,
  // Linha 7
  1, 0, 1, 0, 1, 0, 1, 0
])

// Função para determinar a cor da casa (clara ou escura)
const isDarkSquare = (index) => {
  const row = Math.floor(index / 8)
  const col = index % 8
  return (row + col) % 2 === 1
}

// Guardar a casa selecionada pelo jogador
const selectedSquare = ref(null)

const selectSquare = (index) => {
  if (isDarkSquare(index)) {
    selectedSquare.value = index
  }
}
</script>

<template>
  <div class="flex flex-col items-center space-y-4 w-full">
    <!-- Aumentámos a largura máxima para 600px (ou 640px) -->
    <div class="grid grid-cols-8 border-4 border-amber-900 rounded-lg overflow-hidden shadow-2xl w-full max-w-[600px] aspect-square">
      <div
        v-for="(piece, index) in boardState"
        :key="index"
        @click="selectSquare(index)"
        class="flex items-center justify-center cursor-pointer transition-colors select-none relative"
        :class="[
          isDarkSquare(index) ? 'bg-amber-800' : 'bg-amber-100',
          selectedSquare === index ? 'ring-4 ring-yellow-400 ring-inset' : ''
        ]"
      >
        <!-- Peça Branca -->
        <div 
          v-if="piece === 1" 
          class="w-4/5 h-4/5 rounded-full bg-slate-100 border-4 border-slate-300 shadow-md flex items-center justify-center"
        >
          <div class="w-2/3 h-2/3 rounded-full border border-slate-300"></div>
        </div>

        <!-- Peça Preta -->
        <div 
          v-if="piece === 2" 
          class="w-4/5 h-4/5 rounded-full bg-slate-900 border-4 border-slate-700 shadow-md flex items-center justify-center"
        >
          <div class="w-2/3 h-2/3 rounded-full border border-slate-700"></div>
        </div>
      </div>
    </div>

    <!-- Informação da casa selecionada -->
    <p v-if="selectedSquare !== null" class="text-sm text-slate-500">
      Casa selecionada: <strong class="text-slate-800">#{{ selectedSquare }}</strong>
    </p>
  </div>
</template>