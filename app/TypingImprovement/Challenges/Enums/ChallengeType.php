<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Enums;

enum ChallengeType: string
{
    case COUNTDOWNABLE = 'countdownable';
    case NONE_COUNTDOWNABLE = 'none_countdownable';

    public static function toArray(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
