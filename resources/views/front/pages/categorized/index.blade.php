@extends('front.type.right-sidebar')
@section('content')
    <div>
        <div>
            @include('themes.'. config('theme.name') .'.partials.display')
        </div>
        <main class="">
            <div>
                <h1>Articles in {{$temporalName}}</h1>
            </div>
            <ul>
                @forelse($posts as $post)
                    <li>{{$post->title}}</li>
                @empty
                    <li>No posts in this category</li>
                @endforelse
            </ul>
        </main>
    </div>
@endsection
