@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('Edytuj artykuł')</div>
                    <div class="card-body">
                        @include('articles.errors')
                        <form method="post" action="{{ route('article.update', ['article' => $article]) }}" enctype="multipart/form-data">
                            @include('articles.errors')
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <input type="hidden" id="id" name="id" value="{{ $article->id }}">
                            <div class="form-group">
                                <label for="title">@lang('Tytuł')</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
                            </div>
                            <div class="form-group">
                                <label for="content">@lang('Treść')</label>
                                <textarea id="content" name="content" class="form-control">{{ $article->content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="img">@lang('Zdjęcie')</label>
                                <input type="file" class="form-control-file" id="img" name="img">
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('Zapisz zmiany')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
