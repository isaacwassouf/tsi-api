<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication;

use App\TypingImprovement\Authentication\Contracts\RegistersUser;

class Authentications
{
    public static function registersUserUsing($class): void
    {
        app()->singleton(RegistersUser::class, $class);
    }
}
