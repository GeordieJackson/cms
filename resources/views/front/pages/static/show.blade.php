@extends('front.type.right-sidebar')
@section('content')
    <div>
        <div>
            <h1>{!! $post->title !!}</h1>
            <div>
                {!! $post->body !!}
            </div>
        </div>
    </div>
@endsection
