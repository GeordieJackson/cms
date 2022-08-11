@extends('front.type.right-sidebar')
@section('content')
    <header class="headings-page">
        <div class="headings-page-spacer"></div>
        <div class="headings-page-body">
            <h1>Tags list</h1>
            <div class="headings-page-spacer-b"></div>
        </div>
    </header>

    @if( count($tags))
        <ul>
            @foreach($tags as $tag)
                <li><a href="{{ route('tags.show', $tag->slug) }}">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    @else
        No tags have yet been created
    @endif
@endsection
