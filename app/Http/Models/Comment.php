<?php namespace App\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $article_id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Article $article
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['article_id', 'user_id', 'content', 'created_at', 'updated_at'];

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Http\Models\Article');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
