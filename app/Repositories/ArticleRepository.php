<?php namespace App\Repositories;

use App\Http\Models\Article;
use Illuminate\Support\Collection;

class ArticleRepository
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getAllArticles(): Collection
    {
        return $this->article->all();
    }

    public function getArticleById(int $articleId): Article
    {
        return $this->article->find($articleId);
    }

    public function createNewArticle(string $img): Article
    {
        return $this->article->create(
            [
                'user_id' => auth()->user()->id,
                'title' => request('title'),
                'content' => request('content'),
                'img' => $img,
            ]
        );
    }

    public function updateArticle(int $articleId, string $img)
    {
        return $this->article
            ->where('id', $articleId)
            ->update(
                [
                    'title' => request('title'),
                    'content' => request('content'),
                    'img' => $img,
                ]
            );
    }

    public function deleteArticle($id)
    {
        return $this->article->find($id)->delete();
    }

    public function isUserOwner(int $articleId): bool
    {
        return $this->article->where('id', $articleId)->where('user_id', auth()->user()->id)->first() ? true : false;
    }
}
