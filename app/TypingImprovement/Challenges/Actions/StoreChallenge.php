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
        $this->validate($data);

        /** @var User $user */
        $user = auth()->user();

        // create the challenge
        $user->challenges()->create([
            'challenge_type' => $data['challenge_type'],
            'full_text' => $data['full_text'],
            'completed_text' => $data['completed_text'],
            'time_taken' => $data['time_taken'],
        ]);
    }

    /**
     * @throws ValidationException
     */
    private function validate(array $data): void
    {
        Validator::make($data, [
            'challenge_type' => ['required', 'string', Rule::in(ChallengeType::toArray())],
            'full_text' => ['required', 'string'],
            'completed_text' =>  ['required', 'string'],
            'time_taken' =>  ['required', 'string'],
        ])->validate();
    }
}
