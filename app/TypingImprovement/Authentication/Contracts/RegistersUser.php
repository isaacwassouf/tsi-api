<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Contracts;

use Illuminate\Validation\ValidationException;

interface RegistersUser
{
    /**
     * Register a new user.
     *
     * @throws ValidationException
     */
    public function registerUser(array $input): void;
}
