@extends('dashboard.layout')
@section('meta')
    @parent
    @include('dashboard.editor.editor')
@endsection
@section('head')
    <h1 class="text-4xl">Posts management</h1>
@endsection
@section('content')
    <div class="container-xxxl mx-auto">
        @include('dashboard.posts.includes.errors')
        <form class="js-postform" action="{{ route('dashboard.posts.update', $post->id) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="post_container">
                <div class="post_container-main">
                    <div class="mb-4 w-full">
                        @php
                            $method = 'edit';
                        @endphp
                        @include('dashboard.posts.form_partials.options_bar')
                    </div>
                    @include('dashboard.posts.form_partials.form')
                </div>
                @include('dashboard.posts.form_partials.form_aside')
            </div>
        </form>
    </div>
@endsection
@section('js')
    @include('dashboard.posts.includes.display_options')
@endsection
