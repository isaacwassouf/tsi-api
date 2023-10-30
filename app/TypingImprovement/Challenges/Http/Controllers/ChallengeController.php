<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\TypingImprovement\Challenges\Contracts\StoresChallenge;
use App\TypingImprovement\Challenges\Models\Challenge;
use App\TypingImprovement\Challenges\Resources\ChallengeResource;
use App\TypingImprovement\Challenges\Resources\ChallengeResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Throwable;

class ChallengeController extends Controller
{
    public function index(): ChallengeResourceCollection
    {
        /** @var User $user */
        $user = auth()->user();

        $challenges = $user->challenges()->get();

        return new ChallengeResourceCollection($challenges);
    }

    /**
     * Display the specified challenge.
     */
    public function show(Challenge $challenge): ChallengeResource
    {
        return new ChallengeResource($challenge);
    }

    /**
     * Store a new challenge.
     */
    public function store(): Response|JsonResponse
    {
        $data = request()->all() ?? [];
        try {
            $creator = app(StoresChallenge::class);
            $creator->store($data);

            return response()->noContent(201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            return response()->json([
                'message' =>  $e->getMessage(),
            ], 500);
        }
    }
}
