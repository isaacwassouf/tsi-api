<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Actions;

use App\TypingImprovement\Authentication\Contracts\LogsOutUser;
use Illuminate\Support\Facades\Auth;

class LogOutUser implements LogsOutUser
{
    /**
     * Logout a user.
     *
     */
    public function logsOutUser(): void
    {
        request()->user()->currentAccessToken()->delete();
    }
}
