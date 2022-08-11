<div class="headings-title">
    <h4><span>Tag Cloud</span></h4>
</div>
<div class="tags-body">
    @forelse($tagCloud as $tag)
        <a href="{{ route('tags.show', $tag->slug) }}" class="tag">{{ $tag->name }}</a>@if( ! $loop->last)@endif {{-- Keep inline for page spaces --}}
        @empty
        <p class="text-center">[ No tags set ]</p>
    @endforelse
</div>