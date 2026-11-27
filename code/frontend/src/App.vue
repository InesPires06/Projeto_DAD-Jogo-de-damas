<script setup>
import NavBar from '@/components/layout/NavBar.vue'
</script>

<template>
  <div class="min-h-screen bg-amber-50/40 text-stone-800 selection:bg-amber-200 selection:text-amber-950">
    <NavBar />
    <main class="mx-auto max-w-5xl px-4 py-8">
      <RouterView />
    </main>
  </div>
</template>