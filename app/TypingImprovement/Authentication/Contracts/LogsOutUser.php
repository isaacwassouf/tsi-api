<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Contracts;

interface LogsOutUser
{
    /**
     * Logout a user.
     *
     */
    public function logsOutUser(): void;
}
