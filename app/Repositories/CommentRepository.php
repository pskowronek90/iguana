<?php namespace App\Repositories;

use App\Http\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}
