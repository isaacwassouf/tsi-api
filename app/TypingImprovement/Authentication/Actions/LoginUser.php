<?php

namespace App\TypingImprovement\Authentication\Actions;

use App\Models\User;
use App\TypingImprovement\Authentication\Contracts\LoginsUser;
use App\TypingImprovement\Authentication\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;

class LoginUser implements LoginsUser
{
    /**
     * Login a user.
     *
     * @throws ValidationException|LoginException
     */
    public function loginUser(array $input): NewAccessToken
    {
        $validatedInput = $this->validateInput($input);

        if (Auth::attempt($validatedInput)) {
            // get the user
            $user = User::whereEmail($validatedInput['email'])->firstOrFail();
            // generate and result a new token
            return $user->createToken('auth-token');
        }
        // if the auth attempt fails, throw an exception
        throw new LoginException();
    }

    /**
     * @throws ValidationException
     */
    private function validateInput(array $input): array
    {
        return Validator::make($input, [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:8'],
        ])->validate();
    }
}
