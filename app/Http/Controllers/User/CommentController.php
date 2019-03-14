<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected $articleRepository;
    protected $commentRepository;

    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $this->middleware('auth');
        $this->articleRepository = $articleRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $article = $this->articleRepository->getArticleById(request('id'));
        $comments = $article->comments()->get()->sortByDesc('created_at');

        return view('articles.comments')->with(compact('article', 'comments'));
    }

    public function store()
    {
        $article = $this->articleRepository->getArticleById(request('id'));
        $articles = $this->articleRepository->getAllArticles();

        $comments = $article->comments()->get();
        $validator = validator()->make(request()->all(), $this->rules(), $this->messages());

        if ($this->articleRepository->isUserOwner(request('id')) === true) {
            die('Nie możesz komentować swoich artykułów');
        } elseif ($validator->fails()) {
            $errors = $validator->errors();

            return view('articles.comments')->with(compact('errors', 'article', 'comments'));
        } else {
            $this->commentRepository->addNewComment($article->id);

            return view('home')->with(compact('articles'));
        }




    }

    public function rules(): array
    {
        return $rules = ['content' => 'required|string|min:5|max:250'];
    }

    public function messages(): array
    {
        return $messages = [
            'content.required' => trans('Wpisz treść komentarza'),
            'content.string' => trans('Zły format komentarza'),
            'content.min' => trans('Komentarz musi zawierać co najmniej 5 znaków'),
            'content.max' => trans('Maksymalna długość komentarza wynosi 250 znaków'),
        ];
    }
}
