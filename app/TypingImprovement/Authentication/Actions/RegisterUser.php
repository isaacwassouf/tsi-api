<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Actions;

use App\Models\User;
use App\TypingImprovement\Authentication\Contracts\RegistersUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterUser implements RegistersUser
{
    /**
     * @throws ValidationException
     */
    public function registerUser(array $input): void
    {
        $validatedInput = $this->validateInput($input);

        User::create([
            'name' => $validatedInput['first_name'].' '.$validatedInput['last_name'],
            'email' => $validatedInput['email'],
            'password' => $validatedInput['password'],
        ]);
    }

    /**
     * @throws ValidationException
     */
    private function validateInput(array $input): array
    {
        return Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validateWithBag('registerUser');
    }
}
