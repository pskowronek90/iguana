<?php namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property string $img
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Comment $comments
 */
class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'content', 'img', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Http\Models\Comment');
    }
}
