import { defineStore } from 'pinia';

export const useTypingStore = defineStore('typing', {
  state: () => ({
    playerName: '' as string,
    passage: '' as string,
    passageId: 0,
    inputText: '' as string,
    startedAt: 0,
    endedAt: 0,
    wpm: 0,
    accuracy: 100,
    finished: false,
    refreshLeaderboard: false
  }),

  actions: {
    triggerLeaderboardRefresh() {
      this.refreshLeaderboard = !this.refreshLeaderboard;
    },
    start() {
      this.inputText = '';
      this.startedAt = Date.now();
      this.endedAt = 0;
      this.finished = false;
    },

    finish() {
      this.endedAt = Date.now();
      const durationSec = (this.endedAt - this.startedAt) / 1000;
      const correctChars = this.countCorrectChars();
      this.wpm = (correctChars / 5) / (durationSec / 60);
      this.accuracy = this.calculateAccuracy();
      this.finished = true;
    },

    reset() {
      this.inputText = '';
      this.passage = '';
      this.passageId = 0;
      this.wpm = 0;
      this.accuracy = 100;
      this.finished = false;
    },

    countCorrectChars() {
      let correct = 0;
      for (let i = 0; i < this.inputText.length; i++) {
        if (this.inputText[i] === this.passage[i]) correct++;
      }
      return correct;
    },

    calculateAccuracy() {
      if (this.inputText.length === 0) return 100;
      const correct = this.countCorrectChars();
      return (correct / this.inputText.length) * 100;
    },
  },
});
