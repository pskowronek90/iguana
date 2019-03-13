<?php namespace App\Http\Models;

use App\ArticleComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $article_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property Article $article
 * @property ArticleComment $articleComments
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['article_id', 'content', 'created_at', 'updated_at'];

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Http\Models\Article');
    }

    public function articleComments(): HasMany
    {
        return $this->hasMany('App\Http\Models\ArticleComment');
    }
}
