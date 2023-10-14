<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Contracts;

use Illuminate\Validation\ValidationException;

interface StoresChallenge
{
    /**
     * @param array<string, mixed> $data
     * @return void
     * @throws ValidationException
     */
    public function store(array $data): void;
}
