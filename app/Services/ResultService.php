<?php

namespace App\Services;

use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ResultService
{
   public function store(array $data): array
    {

        if ($data['wpm'] > 200 && $data['accuracy'] > 99 && $data['duration_ms'] < 8000) {
            abort(422, 'Invalid typing data — possible cheating detected.');
        }

        $result = Result::create([
            'passage_id' => $data['passage_id'],
            'name' => $data['name'] ?? 'anonymous',
            'wpm' => $data['wpm'],
            'accuracy' => $data['accuracy'],
            'duration_ms' => $data['duration_ms'],
        ]);

        $rank = Result::where('wpm', '>', $result->wpm)->count() + 1;
        $total = Result::count();
        $percentile = round(100 * (1 - ($rank - 1) / $total), 2);

        return [
            'id' => $result->id,
            'name' => $result->name,
            'wpm' => $result->wpm,
            'accuracy' => $result->accuracy,
            'duration_ms' => $result->duration_ms,
            'rank' => $rank,
            'percentile' => $percentile,
        ];
    }


    public function leaderboard(int $limit = 50)
    {
        return Result::orderByDesc('wpm')
            ->orderByDesc('accuracy')
            ->take($limit)
            ->get();
    }
}
