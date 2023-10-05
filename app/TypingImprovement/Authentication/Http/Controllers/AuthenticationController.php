<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\TypingImprovement\Authentication\Contracts\LoginsUser;
use App\TypingImprovement\Authentication\Contracts\LogsOutUser;
use App\TypingImprovement\Authentication\Contracts\RegistersUser;
use App\TypingImprovement\Authentication\Exceptions\LoginException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthenticationController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(): Response|JsonResponse
    {
        $input = request()->all() ?? [];
        try {
            $registerer = app(RegistersUser::class);
            $registerer->registerUser($input);

            return response()->noContent(200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Login a user.
     */
    public function login(): Response|JsonResponse
    {
        $input = request()->all() ?? [];
        try {

            $authenticator = app(LoginsUser::class);
            $authenticator->loginUser($input);

            return response()->noContent(200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (LoginException) {
            return response()->json(['message' => 'Invalid credentials'], 400);
        }
    }

    /**
     * Logout a user.
     */
    public function logout(): Response
    {
        try {
            $authenticator = app(LogsOutUser::class);
            $authenticator->logsOutUser();

            return response()->noContent(200);
        } catch (Throwable) {
            return response()->noContent(500);
        }
    }

    /**
     * Get the authenticated User.
     */
    public function verifiedUser(): JsonResponse
    {
        /** @var User|null $user */
        $user = auth()?->user();

        if ($user) {
            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
