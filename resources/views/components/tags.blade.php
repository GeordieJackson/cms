<div class="headings-title">
    <h4><span>Article Tags</span></h4>
</div>
<div class="tags-body">
    @foreach($tagList as $tag)
        <a href="{{ route('tags.show', $tag->slug) }}" class="tag">{{ $tag->name }}</a>@if( ! $loop->last)@endif {{-- Keep inline for page spaces --}}
    @endforeach
</div>