<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $article_id
 * @property int $comment_id
 * @property string $created_at
 * @property string $updated_at
 * @property Article $article
 * @property Comment $comment
 */
class ArticleComment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['article_id', 'comment_id', 'created_at', 'updated_at'];

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Http\Models\Article');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo('App\Http\Models\Comment');
    }
}
