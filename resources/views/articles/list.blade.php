@if(!is_null($articles) && $articles->isNotEmpty())
    @foreach($articles as $article)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset("img/thumbs/$article->img") }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <a href="#" class="btn btn-primary">@lang('Czytaj więcej')</a>
                <form method="post" action="{{ route('article.destroy', ['id' => $article->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">@lang('Usuń')</button>
                </form>
            </div>
        </div>
    @endforeach
@else
    <p>Brak artukułów</p>
@endif
