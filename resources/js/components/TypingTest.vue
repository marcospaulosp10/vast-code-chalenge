<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useTypingStore } from '../store/useTypingStore';
import api from '../services/api';

const store = useTypingStore();
const loading = ref(false);
const started = ref(false);
const progress = computed(() => (store.inputText.length / store.passage.length) * 100);

async function loadPassage() {
  loading.value = true;
  const { data } = await api.getRandomPassage();
  const passage = data.data || data;
  store.passage = passage.body;
  store.passageId = passage.id;
  loading.value = false;
}

function startTest() {
  if (!store.playerName.trim()) {
    alert('Please enter your name before starting.');
    return;
  }
  started.value = true;
  store.start();
}

function onInput(e: Event) {
  const value = (e.target as HTMLTextAreaElement).value;
  store.inputText = value;

  if (value.length >= store.passage.length) {
    store.finish();
    sendResult();
  }
}

async function sendResult() {
  const payload = {
    passage_id: store.passageId,
    name: store.playerName,
    wpm: parseFloat(store.wpm.toFixed(2)),
    accuracy: parseFloat(store.accuracy.toFixed(2)),
    duration_ms: store.endedAt - store.startedAt,
  };

  await api.submitResult(payload);

  store.triggerLeaderboardRefresh();
}

async function restart() {
  store.reset();
  started.value = false;
  await loadPassage();
}

onMounted(loadPassage);
</script>

<template>
  <div class="bg-white p-8 rounded-2xl shadow-lg">
    <h1 class="text-3xl font-semibold mb-6 text-center text-primary">Typing Speed Test</h1>

    <!-- Step 1: Ask for name -->
    <div v-if="!started && !store.finished && !loading">
      <input
        v-model="store.playerName"
        placeholder="Enter your name..."
        class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:ring-2 focus:ring-primary focus:outline-none"
      />
      <button
        class="w-full bg-primary text-white font-semibold py-2 rounded-md hover:bg-indigo-700"
        @click="startTest"
      >
        Start Test
      </button>
    </div>

    <!-- Step 2: Loading -->
    <div v-if="loading" class="text-center text-gray-500 py-12">Loading passage...</div>

    <!-- Step 3: Typing area -->
    <div v-if="started && !store.finished && !loading">
      <div class="text-gray-700 mb-4 text-justify leading-relaxed bg-gray-50 p-4 rounded-lg border select-none">
        <span
          v-for="(char, idx) in store.passage"
          :key="idx"
          :class="{
            'text-green-600': store.inputText[idx] === char,
            'text-red-500': store.inputText[idx] && store.inputText[idx] !== char,
            'bg-yellow-100': idx === store.inputText.length && !store.finished,
          }"
        >
          {{ char }}
        </span>
      </div>

      <textarea
        v-model="store.inputText"
        @input="onInput"
        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary focus:outline-none min-h-[100px]"
        placeholder="Start typing..."
      ></textarea>

      <div class="mt-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-600">WPM: <span class="font-semibold">{{ store.wpm.toFixed(1) }}</span></p>
          <p class="text-sm text-gray-600">Accuracy: <span class="font-semibold">{{ store.accuracy.toFixed(1) }}%</span></p>
        </div>
        <div class="flex-1 mx-4 bg-gray-200 h-2 rounded-full overflow-hidden">
          <div class="bg-primary h-2 transition-all duration-300" :style="{ width: progress + '%' }"></div>
        </div>
      </div>
    </div>

    <!-- Step 4: Results -->
    <div v-if="store.finished && !loading" class="text-center mt-8">
      <p class="text-lg text-gray-700 mb-4">
        You have finisd, <span class="font-semibold text-primary">{{ store.playerName }}</span>!
      </p>
      <p class="text-gray-600 mb-6">Your result was {{ store.wpm.toFixed(1) }} WPM with {{ store.accuracy.toFixed(1) }}% accuracy.</p>
      <button
        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-indigo-700"
        @click="restart"
      >
        Restart
      </button>
    </div>
  </div>
</template>
