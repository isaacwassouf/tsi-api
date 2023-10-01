<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TypingImprovement\Authentication\Contracts\LoginsUser;
use App\TypingImprovement\Authentication\Contracts\RegistersUser;
use App\TypingImprovement\Authentication\Exceptions\LoginException;
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

    /**
     * Login a user.
     *
     * @return Response|JsonResponse
     */
    public function login(): Response| JsonResponse
    {
        $input = request()->all() ?? [];
        try{

            $authenticator = app(LoginsUser::class);
            $authenticator->loginUser($input);

            return response()->noContent(200);
        }catch (ValidationException $e){
            return response()->json($e->errors(), 422);
        }catch (LoginException){
            return response()->json(['message' => 'Invalid credentials'], 400);
        }
    }
}
