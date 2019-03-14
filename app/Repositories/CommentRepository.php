<?php namespace App\Repositories;

use App\Http\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function addNewComment(int $articleId): Comment
    {
        return $this->comment->create(
            [
                'article_id' => $articleId,
                'user_id' => auth()->user()->id,
                'content' => request('content'),
            ]
        );
    }
}
