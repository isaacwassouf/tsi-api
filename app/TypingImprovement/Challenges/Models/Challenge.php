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
 * @property string $time_taken
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 *
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 *
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
