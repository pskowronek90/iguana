@extends('layouts.app')

@auth
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('Nowy artykuł')</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
                            @include('articles.errors')
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">@lang('Tytuł')</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="content">@lang('Treść')</label>
                                <textarea id="content" name="content" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="img">@lang('Zdjęcie')</label>
                                <input type="file" class="form-control-file" id="img" name="img">
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('Utwórz')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
