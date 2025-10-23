<script setup lang="ts">
import { ref, onMounted, nextTick, watch } from 'vue';
import { useTypingStore } from '../store/useTypingStore';
import api from '../services/api';

const store = useTypingStore();
const leaderboard = ref<any[]>([]);
const loading = ref(true);

async function loadLeaderboard() {
  try {
    const { data } = await api.getLeaderboard();
    const results = Array.isArray(data) ? data : data.data || [];

    leaderboard.value = results.map(item => ({
      ...item,
      wpm: parseFloat(item.wpm),
      accuracy: parseFloat(item.accuracy),
    }));

    await nextTick();
  } catch (error) {
    console.error('Error fetching leaderboard:', error);
  } finally {
    loading.value = false;
  }
}

onMounted(loadLeaderboard);

watch(
  () => store.refreshLeaderboard,
  async () => {
    loading.value = true;
    await loadLeaderboard();
  }
);
</script>


<template>
  <div class="bg-white p-6 rounded-2xl shadow-lg">
    <h2 class="text-xl font-semibold text-center mb-4 text-primary">Leaderboard</h2>
    <div v-if="loading" class="text-center text-gray-500 py-6">Loading...</div>

    <table v-else class="w-full text-sm text-left">
      <thead class="border-b text-gray-700">
        <tr>
          <th class="py-2">#</th>
          <th>Name</th>
          <th>WPM</th>
          <th>Accuracy</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(item, i) in leaderboard"
          :key="item.id"
          class="border-b hover:bg-gray-50"
        >
          <td class="py-2">{{ i + 1 }}</td>
          <td>{{ item.name || 'Anonymous' }}</td>
          <td>{{ item.wpm.toFixed(1) }}</td>
          <td>{{ item.accuracy.toFixed(1) }}%</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
