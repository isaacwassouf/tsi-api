<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication;

use App\TypingImprovement\Authentication\Contracts\LoginsUser;
use App\TypingImprovement\Authentication\Contracts\LogsOutUser;
use App\TypingImprovement\Authentication\Contracts\RegistersUser;

class Authentications
{
    public static function registersUserUsing($class): void
    {
        app()->singleton(RegistersUser::class, $class);
    }

    public static function loginsUserUsing($class): void
    {
        app()->singleton(LoginsUser::class, $class);
    }

    public static function logsOutUserUsing($class): void
    {
        app()->singleton(LogsOutUser::class, $class);
    }
}
