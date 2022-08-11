<div class="tags">
    <div class="tags-header">Tags</div>
    <div class="tags-body">
        @foreach($tags as $tag)
            {!! $tag !!}@if( ! $loop->last), @endif
        @endforeach
    </div>

</div>
