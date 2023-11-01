<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ChallengeResourceCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'challenges';

    public function toArray($request): Collection
    {
        return $this->collection->transform(function ($challenge) {
            return [
                'id' => $challenge->id,
                'challenge_type' => $challenge->challenge_type,
                'wpm' => $challenge->wpm,
                'accuracy' => $challenge->accuracy,
                'duration' => $challenge->time_taken,
                'taken_at' => Carbon::parse($challenge->created_at)->format('Y-m-d H:i:s'),
            ];
        });
    }
}
