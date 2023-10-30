<?php

namespace App\TypingImprovement\Users\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateGeneralInformation
{
    /**
     * @throws ValidationException
     */
    public function update(array $data): void
    {
        $validatedData = $this->validate($data);
        /** @var User $user */
        $user = auth()->user();

        $user->fill([
            'name' => $validatedData['first_name'] . ' ' .$validatedData['last_name'],
            'email' => $validatedData['email']
        ]);

        $user->save();
    }

    /**
     * @throws ValidationException
     */
    private function validate(array $data): array
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ])->validate();
    }
}
