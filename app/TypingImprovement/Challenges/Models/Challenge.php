<?php

namespace App\TypingImprovement\Challenges\Models;

use App\Models\User;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\TypingImprovement\Challenges\Models\Challenge.
 *
 * @property int $id
 * @property string $challenge_type
 * @property string $full_text
 * @property string $completed_text
 * @property float $time_taken
 * @property string $quote_id
 * @property int $wpm
 * @property float $accuracy
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|Challenge whereAccuracy($value)
 * @method static Builder|Challenge whereChallengeType($value)
 * @method static Builder|Challenge whereCompletedText($value)
 * @method static Builder|Challenge whereCreatedAt($value)
 * @method static Builder|Challenge whereId($value)
 * @method static Builder|Challenge whereQuoteId($value)
 * @method static Builder|Challenge whereTimeTaken($value)
 * @method static Builder|Challenge whereUpdatedAt($value)
 * @method static Builder|Challenge whereUserId($value)
 * @method static Builder|Challenge whereWpm($value)
 * @mixin Eloquent
 */
class Challenge extends Model
{
    use HasFactory;

    protected $table = 'challenges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'full_text',
        'completed_text',
        'time_taken',
        'quote_id',
        'wpm',
        'accuracy',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'time_taken' => 'integer',
    ];

    /**
     * Get the user that owns the challenge.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
