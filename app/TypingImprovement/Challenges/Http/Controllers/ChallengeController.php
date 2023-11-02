<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\TypingImprovement\Challenges\Contracts\StoresChallenge;
use App\TypingImprovement\Challenges\Models\Challenge;
use App\TypingImprovement\Challenges\Resources\ChallengeResource;
use App\TypingImprovement\Challenges\Resources\ChallengeResourceCollection;
use App\TypingImprovement\Challenges\Resources\ChallengesAreaChartCollection;
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

        $sortBy = request()->query('sort_by', 'created_at');
        $sortDirection = request()->query('sort_direction', 'desc');

        $challenges = $user->challenges()
            ->orderBy($sortBy, $sortDirection)
            ->get();

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

    public function fetchAreaChartData(): ChallengesAreaChartCollection
    {
        /** @var User $user */
        $user = auth()->user();

        $window = request()->query('window', 'week');

        $challenges = $user->challenges()
            ->orderBy('created_at')
            ->select(['created_at', 'wpm'])
            ->when($window === 'today', function ($query) {
                $query->whereDay('created_at', now()->day);
            })
            ->when($window === 'week', function ($query) {
                $query->where('created_at', '>=', now()->subWeek());
            })
            ->when($window === 'month', function ($query) {
                $query->where('created_at', '>=', now()->subMonth());
            })
            ->get();

        return new ChallengesAreaChartCollection($challenges);
    }
}
