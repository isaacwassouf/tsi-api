<?php

declare(strict_types=1);

use App\TypingImprovement\Challenges\Http\Controllers\ChallengeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'challenges',
    'middleware' => 'web'
], function () {
    Route::middleware('auth:sanctum')
        ->post('/', [ChallengeController::class, 'store']);
    Route::middleware('auth:sanctum')
        ->get('/', [ChallengeController::class, 'index']);
});
