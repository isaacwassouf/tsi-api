<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\TypingImprovement\Authentication\Http\Controllers\AuthenticationController;

Route::group([
    'prefix' => 'auth',
], function (){
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('login', [AuthenticationController::class, 'login'])->middleware('web');
});
