<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Actions;

use App\TypingImprovement\Challenges\Contracts\StoresChallenge;
use App\TypingImprovement\Challenges\Enums\ChallengeType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class StoreChallenge implements StoresChallenge
{
    /**
     * @param array<string, mixed> $data
     *  @return void
     *  @throws ValidationException
     */
    public function store(array $data): void
    {
        // validate the data
        $validatedData =  $this->validate($data);

        /** @var User $user */
        $user = auth()->user();

        // create the challenge
        $user->challenges()->create([
            'challenge_type' => $validatedData['challenge_type'],
            'quote_id' => $validatedData['quote_id'],
            'completed_text' => $validatedData['completed_text'] ?? null,
            'time_taken' => $validatedData['time_taken'],
            'wpm' => $validatedData['wpm'],
            'accuracy' => $validatedData['accuracy'],
        ]);
    }

    /**
     * @throws ValidationException
     */
    private function validate(array $data): array
    {
        return Validator::make($data, [
            'challenge_type' => ['required', 'string', Rule::in(ChallengeType::toArray())],
            'quote_id' => ['required', 'string'],
            'completed_text' =>  ['sometimes', 'string'],
            'time_taken' =>  ['required', 'numeric'],
            'wpm' =>  ['required', 'integer'],
            'accuracy' =>  ['required', 'numeric'],
        ])->validate();
    }
}
