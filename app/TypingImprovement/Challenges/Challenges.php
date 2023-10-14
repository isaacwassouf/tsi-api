<?php

namespace App\TypingImprovement\Challenges;

use App\TypingImprovement\Challenges\Contracts\StoresChallenge;

class Challenges
{
    public static function storesChallenge($class): void
    {
        app()->singleton(StoresChallenge::class, $class);
    }
}
