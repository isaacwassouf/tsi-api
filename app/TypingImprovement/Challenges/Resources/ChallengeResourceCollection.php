<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChallengeResourceCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'challenges';

    public function toArray($request): array
    {
        return $this->collection->toArray();
    }
}
