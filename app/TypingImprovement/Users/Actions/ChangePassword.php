<?php

namespace App\TypingImprovement\Users\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ChangePassword
{
    /**
     * @throws ValidationException
     */
    public function change(array $input): void
    {
        $validatedInput =  $this->validate($input);
        /** @var User $user */
        $user = auth()->user();

        $user->password = $validatedInput['new_password'];
        $user->save();
    }

    /**
     * @throws ValidationException
     */
    private function validate(array $input): array
    {
        return Validator::make($input, [
           'current_password' => ['required', 'string'],
           'new_password' => ['required', 'string', 'min:8' ,'confirmed']
        ])->validate();
    }
}
