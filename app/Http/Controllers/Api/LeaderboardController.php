<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaderboardResource;
use App\Services\ResultService;

class LeaderboardController extends Controller
{
    public function __construct(protected ResultService $service) {}

    public function index()
    {
        $results = $this->service->leaderboard();
        return LeaderboardResource::collection($results);
    }
}
