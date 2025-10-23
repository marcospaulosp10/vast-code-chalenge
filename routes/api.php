<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassageController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\LeaderboardController;

Route::get('/passages/random', [PassageController::class, 'random']);
Route::post('/results', [ResultController::class, 'store']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
