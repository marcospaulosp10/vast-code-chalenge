<script setup lang="ts">
import TypingTest from './components/TypingTest.vue';
import Leaderboard from './components/Leaderboard.vue';
</script>

<template>
  <main class="min-h-screen py-8 px-4">
    <div class="grid gap-8 md:grid-cols-[2fr_1fr] max-w-6xl mx-auto">
      <TypingTest />
      <Leaderboard />
    </div>
  </main>
</template>
