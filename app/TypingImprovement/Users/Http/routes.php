<?php

use Illuminate\Support\Facades\Route;
use App\TypingImprovement\Users\Http\Controllers\UsersController;

Route::group([
    'prefix' => 'users',
    'middleware' => 'web',
], function () {
    Route::middleware('auth:sanctum')->patch('password', [UsersController::class, 'changePassword']);
    Route::middleware('auth:sanctum')->patch('general', [UsersController::class, 'changeGeneralInfo']);
});

