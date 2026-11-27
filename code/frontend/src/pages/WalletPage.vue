<script setup>
import { ref } from 'vue'

const balance = ref(150)

// Controlo da Ficha Selecionada (10, 25, 50, 100 ou 'custom')
const selectedPreset = ref(25)
const isCustomMode = ref(false)
const customValue = ref('')

const transactions = ref([
  { id: 1, type: 'Bónus', desc: 'Bónus de Boas-Vindas ao Clube', amount: '+50', time: '14:20', tag: 'Bónus' },
  { id: 2, type: 'Vitória', desc: 'Vitória na Partida #2 vs. João Santos', amount: '+100', time: 'Ontem', tag: 'Prémio' },
  { id: 3, type: 'Jogo', desc: 'Entrada na Partida #3 (Competitivo)', amount: '-10', time: '25 Nov', tag: 'Aposta' }
])

const selectPreset = (qty) => {
  isCustomMode.value = false
  selectedPreset.value = qty
}

const enableCustom = () => {
  isCustomMode.value = true
}

const handleDeposit = () => {
  const amountToAdd = isCustomMode.value ? Number(customValue.value) : selectedPreset.value
  
  if (!amountToAdd || amountToAdd <= 0) {
    alert('Por favor insere um valor válido de moedas.')
    return
  }

  balance.value += amountToAdd
  
  transactions.value.unshift({
    id: Date.now(),
    type: 'Carregamento',
    desc: 'Adição de Fichas à Carteira',
    amount: `+${amountToAdd}`,
    time: 'Agora',
    tag: 'Fichas'
  })

  alert(`Sucesso! Foram adicionadas ${amountToAdd} moedas de ouro ao teu saldo.`)
  if (isCustomMode.value) customValue.value = ''
}
</script>

<template>
  <div class="max-w-4xl mx-auto space-y-8">
    
    <!-- Cabeçalho Limpo & Placa de Saldo Integrada -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-amber-200/80 pb-6">
      <div>
        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-100/80 text-amber-900 text-xs font-semibold mb-2">
          <span>🏆 Clube de Damas Portuguesas</span>
        </div>
        <h1 class="text-3xl font-serif font-bold text-amber-950">Carteira do Jogador</h1>
      </div>

      <!-- Placa de Saldo Elegante -->
      <div class="bg-amber-900 text-amber-50 px-5 py-3 rounded-2xl shadow-md flex items-center space-x-4 border border-amber-800">
        <div class="w-10 h-10 rounded-full bg-amber-500/20 border border-amber-400/30 flex items-center justify-center text-lg">
          🪙
        </div>
        <div>
          <p class="text-[10px] uppercase font-bold tracking-wider text-amber-300/80">Saldo de Moedas</p>
          <p class="text-2xl font-serif font-black text-amber-200 leading-none">
            {{ balance }} <span class="text-xs font-sans font-normal text-amber-300/70">fichas</span>
          </p>
        </div>
      </div>
    </div>

    <!-- SELEÇÃO DE FICHAS: Fichas Predefinidas + Moeda Personalizada -->
    <div class="bg-white p-6 rounded-2xl border border-amber-200/80 shadow-sm space-y-4">
      <div class="flex items-center justify-between">
        <h2 class="text-base font-serif font-bold text-amber-950">Escolher Fichas para Carregar</h2>
        <span class="text-xs text-stone-500">Seleciona o valor desejado</span>
      </div>

      <!-- Fichas em Tamanho Moderado e Harmonioso -->
      <div class="grid grid-cols-5 gap-3">
        <!-- Fichas Predefinidas -->
        <button 
          v-for="qty in [10, 25, 50, 100]" 
          :key="qty"
          @click="selectPreset(qty)"
          type="button"
          class="h-20 rounded-2xl border-2 transition-all flex flex-col items-center justify-center space-y-0.5 select-none"
          :class="!isCustomMode && selectedPreset === qty 
            ? 'bg-amber-700 text-white border-amber-800 shadow-md ring-2 ring-amber-400/50 scale-[1.03]' 
            : 'bg-amber-50/50 text-amber-950 border-amber-200/80 hover:bg-amber-100/60'"
        >
          <span class="text-xs opacity-60">🪙</span>
          <span class="text-base font-serif font-bold">+{{ qty }}</span>
        </button>

        <!-- Ficha de Valor Personalizado -->
        <button 
          @click="enableCustom"
          type="button"
          class="h-20 rounded-2xl border-2 transition-all flex flex-col items-center justify-center space-y-0.5 select-none"
          :class="isCustomMode 
            ? 'bg-amber-900 text-amber-100 border-amber-950 shadow-md ring-2 ring-amber-400/50 scale-[1.03]' 
            : 'bg-stone-50 text-stone-700 border-stone-300 hover:bg-stone-100'"
        >
          <span class="text-xs">✏️</span>
          <span class="text-xs font-bold uppercase tracking-wider">Outro</span>
        </button>
      </div>

      <!-- Campo de Entrada (Apenas visível se a Ficha Personalizada for ativada) -->
      <div v-if="isCustomMode" class="pt-2 animate-fadeIn">
        <label class="block text-xs font-semibold text-stone-700 mb-1">
          Digita a quantia personalizada de moedas:
        </label>
        <div class="flex items-center gap-3">
          <input 
            v-model="customValue"
            type="number" 
            min="1"
            placeholder="Ex: 75"
            class="w-full px-4 py-2 text-sm bg-stone-50 border border-amber-300 rounded-xl text-stone-900 focus:outline-none focus:ring-2 focus:ring-amber-600 font-bold"
          />
        </div>
      </div>

      <!-- Botão de Ação -->
      <div class="pt-2 flex justify-end">
        <button 
          @click="handleDeposit"
          class="px-8 py-2.5 bg-amber-800 hover:bg-amber-700 text-amber-50 font-bold text-sm rounded-xl transition-all shadow-md flex items-center space-x-2"
        >
          <span>Confirmar Carregamento</span>
          <span>→</span>
        </button>
      </div>
    </div>

    <!-- REGISTO DE MOVIMENTOS: Linha do Tempo Limpa -->
    <div class="bg-white p-6 rounded-2xl border border-amber-200/80 shadow-sm space-y-4">
      <div class="flex items-center justify-between border-b border-stone-100 pb-3">
        <h2 class="text-base font-serif font-bold text-amber-950">Histórico de Movimentos</h2>
        <span class="text-xs text-stone-400 font-mono">Últimas transações</span>
      </div>

      <div class="relative pl-6 space-y-4 before:absolute before:left-2.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-amber-200">
        <div 
          v-for="item in transactions" 
          :key="item.id"
          class="relative flex items-center justify-between group"
        >
          <div class="absolute -left-6 w-3 h-3 rounded-full bg-amber-600 border-2 border-white"></div>

          <div class="space-y-0.5">
            <div class="flex items-center space-x-2">
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-100/70 text-amber-900 border border-amber-200/60">
                {{ item.tag }}
              </span>
              <span class="text-xs text-stone-400 font-mono">{{ item.time }}</span>
            </div>
            <p class="text-sm font-medium text-stone-800">{{ item.desc }}</p>
          </div>

          <span 
            class="text-base font-serif font-bold"
            :class="item.amount.startsWith('+') ? 'text-emerald-700' : 'text-rose-700'"
          >
            {{ item.amount }} 🪙
          </span>
        </div>
      </div>
    </div>

  </div>
</template>