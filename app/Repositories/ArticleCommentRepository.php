<?php namespace App\Repositories;

use App\Http\Models\ArticleComment;

class ArticleCommentRepository
{
    protected $articleComment;

    public function __construct(ArticleComment $articleComment)
    {
        $this->articleComment = $articleComment;
    }
}
