<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TypingImprovement\Authentication\Contracts\RegistersUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    /**
     * Register a new user.
     *
     * @return Response|JsonResponse
     */
    public function register(): Response| JsonResponse
    {
        $input = request()->all() ?? [];
        try{
            $registerer = app(RegistersUser::class);
            $registerer->registerUser($input);

            return response()->noContent(200);
        }catch (ValidationException $e){
            return response()->json($e->errors(), 422);
        }
    }
}
