<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class HomeController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware('auth');
        $this->articleRepository = $articleRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = $this->articleRepository->getAllArticles();

        return view('home')->with(compact('articles'));
    }
}
