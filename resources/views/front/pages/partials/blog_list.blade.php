<div class="listing">
    @forelse($posts as $post)
        <article class="listing-item">
            <div class="listing-img">
                @if($post->image)
                    <img src="{{ asset('storage/images/' . $post->image) }}" alt="">
                @endif
            </div>
            <div class="flex-col w-full">
                <div class="flex-col px-2">
                    <div>
                        <a class="blog-item-link" href="{{ url($post->temporal->slug ?? '', $post->slug) }}">
                            <h1 class="listing-title">{{display($post->title, 'f')}}</h1>
                        </a>
                    </div>
                    <div class="listing-info">
                        <span class="icon-user"></span>
                        <a href="{{ route('authors.show', $post->owner->slug) }}">{{ $post->owner->name }}</a>
                        <span class="icon-file-text"></span>{{publicationDate($post->publication_date)}}
                    </div>
                </div>
                <div class="listing-body">
                    {!! $post->summary !!}
                </div>
            </div>
        </article>
    @empty
        <p>No posts returned</p>
    @endforelse
</div>
<div class="text-center">{{ $posts->links('pagination.pagination') }}</div>
