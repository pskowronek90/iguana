<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    protected $article;
    protected $articleRepository;

    public function __construct(Article $article, ArticleRepository $articleRepository)
    {
        $this->middleware('auth');
        $this->article = $article;
        $this->articleRepository = $articleRepository;

    }

    public function create()
    {
        return view('articles.create');
    }

    public function store()
    {
        $validator = validator()->make(request()->all(), $this->rules(), $this->messages());

        if ($validator->fails()) {
            $errors = $validator->errors();

            return redirect()->route('article.create')->with(compact('errors'));
        }

        $this->articleRepository->createNewArticle($this->saveThumbnail());

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $article = $this->articleRepository->getArticleById($id) ?: die('Nie ma takiego artykułu');

        if ($this->articleRepository->isUserOwner($id) === false) {
            die('Nie jesteś właścicielem tego artykułu');
        }

        return view('articles.edit')->with(compact('article'));
    }

    public function update()
    {
        $article = $this->articleRepository->getArticleById(request('id')) ?: null;


        if (is_null($article)) {
            die('Nie ma takiego artykułu');
        } elseif ($this->articleRepository->isUserOwner(request('id')) === false) {
            die('Nie jesteś właścicielem tego artykułu');
        }

        $validator = validator()->make(request()->all(), $this->updateRules(), $this->messages());

        if ($validator->fails()) {
            $errors = $validator->errors();

            return view('articles.edit')->with(['article' => $article, 'errors' => $errors]);
        } else {
            $this->articleRepository->updateArticle(
                request('id'),
                !is_null(request('file'))
                    ? $this->saveThumbnail()
                    : $article->img);

            return redirect()->route('home');
        }
    }

    public function destroy($id)
    {
        !is_null($this->articleRepository->getArticleById($id))
            ? $this->articleRepository->deleteArticle($id)
            : die('Nie ma takiego artykułu');

        if ($this->articleRepository->isUserOwner($id) === true) {
            die('Nie jesteś właścicielem tego artykułu');
        }


        return redirect()->route('home');
    }

    public function saveThumbnail(): string
    {
        $fileName = $fileName = rand(100, 9999) . "." . request('img')->getClientOriginalExtension();
        request('img')->storeAs("thumbs", $fileName, 'img');

        return $fileName;
    }

    public function updateRules(): array
    {
        return $rules = [
            'title' => 'required|string|min:10',
            'content' => 'required|string|min:10',
            'img' => 'nullable|mimetypes:image/gif,image/jpg,image/jpeg,image/png',
        ];
    }

    public function rules(): array
    {
        return $rules = [
            'title' => 'required|string|min:10',
            'content' => 'required|string|min:10',
            'img' => 'required|mimetypes:image/gif,image/jpg,image/jpeg,image/png',
        ];
    }

    public function messages(): array
    {
        return $messages = [
            'title.required' => trans('Podaj tytuł'),
            'title.string' => trans('Niepoprawny format'),
            'title.min' => trans('Tytuł musi zawierać co najmniej 10 znaków'),
            'content.required' => trans('Treść artykułu wymagana'),
            'content.string' => trans('Niepoprawny format'),
            'content.min' => trans('Treść artykułu musi zawierać co najmniej 10 znaków'),
            'img.required' => trans('Zdjęcie wymagane'),
            'img.mimetypes' => trans('Zdjęcie musi być zapisane w pliku jpg/jpeg, png lub gif'),
        ];
    }
}
