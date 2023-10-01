<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Contracts;

use App\TypingImprovement\Authentication\Exceptions\LoginException;
use Illuminate\Validation\ValidationException;

interface LoginsUser
{
    /**
     * Login a user.
     *
     * @throws ValidationException|LoginException
     */
    public function loginUser(array $input): void;
}
