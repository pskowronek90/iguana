@extends('layouts.app')

@section('content')
    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">@lang('Komentarze')</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if(!is_null($comments) || $comments->isNotEmpty())
                                @foreach($comments as $comment)
                                    <p>{{ $comment->created_at }}</p>
                                    <h5><b>{{ $comment->user->email }}</b></h5>
                                    <p>{{ $comment->content }}</p>
                                @endforeach
                            @endif
                        </div>
                        @if(auth()->user()->id !== $article->user_id)
                            @include('articles.comment-add')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
