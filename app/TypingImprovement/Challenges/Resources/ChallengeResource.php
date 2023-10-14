<?php

declare(strict_types=1);

namespace App\TypingImprovement\Challenges\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'challenge';

    public function toArray($request): array
    {
        /** @var Request $request */
        return [
            'id' => $this->id,
            'challenge_type' => $this->challenge_type,
            'full_text' => $this->full_text,
            'completed_text' => $this->completed_text,
            'time_taken' => $this->time_taken,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
