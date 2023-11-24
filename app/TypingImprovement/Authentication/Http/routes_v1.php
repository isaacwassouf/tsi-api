<?php

declare(strict_types=1);

use App\TypingImprovement\Authentication\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'middleware' => 'api',
], function () {
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::get('verify', [AuthenticationController::class, 'verifiedUser']);
});
