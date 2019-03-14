<div class="card-body">
    @include('articles.errors')
    <form method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="content">@lang('Wpisz swój komentarz')</label><br>
            <textarea id="content" name="content" class="form-control"></textarea><br>
            <button type="submit" class="btn btn-primary">@lang('Utwórz')</button>
        </div>
    </form>
</div>
