<?php

namespace App\TypingImprovement\Authentication\Actions;

use App\TypingImprovement\Authentication\Contracts\LoginsUser;
use App\TypingImprovement\Authentication\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginUser implements LoginsUser
{

    /**
     * @param array $input
     * @return void
     * @throws ValidationException|LoginException
     */
    public function loginUser(array $input): void
    {
        $validatedInput = $this->validateInput($input);

       if (Auth::attempt($validatedInput)){
           request()->session()->regenerate();
           return;
       }
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
