<header class="headings-page">
    <div class="headings-page-spacer"></div>
    <div class="headings-page-body">
        <h1>{{ display($post->title, 'f') }}</h1>
        @if($post->subtitle)
            <h2>{{ display($post->subtitle, 'f') }}</h2>
        @endif
        <address class="listing-info">
            <span class="icon-user"></span><a rel="author"
                                              href="{{ route('authors.show', ['author' => $author->slug]) }}">{{ $author->name }}</a><span
                    class="icon-file-text"></span> {{ $publication_date }}
        </address>
        <div class="headings-page-spacer-b"></div>
    </div>
</header>
<article>
    <div class="prose">
        {!! $post->body !!}
    </div>
{{--    <footer class="article-footer">Article Footer</footer>--}}
</article>
