@auth
    @if(!is_null($articles) && $articles->isNotEmpty())
        @foreach($articles as $article)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("img/thumbs/$article->img") }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p>{{ $article->content }}</p>
                    <a href="{{ route('comments.index', ['id' => $article->id]) }}" class="btn btn-primary">@lang('Komentarze')</a><br>
                    @if(auth()->user()->id === $article->user_id)
                        <a href="{{ route('article.edit', ['article' => $article]) }}" class="btn btn-warning">Edytuj</a><br>
                        <form method="post" action="{{ route('article.destroy', ['id' => $article->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger">@lang('Usuń')</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>Brak artukułów</p>
    @endif
@endauth
