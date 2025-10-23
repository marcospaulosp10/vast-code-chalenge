import axios from 'axios';

const api = axios.create({
  baseURL: '/api',
});

export default {
  getRandomPassage() {
    return api.get('/passages/random');
  },
  submitResult(data: {
    passage_id: number;
    name: string;
    wpm: number;
    accuracy: number;
    duration_ms: number;
  }) {
    return api.post('/results', data);
  },
  getLeaderboard() {
    return api.get('/leaderboard');
  },
};
