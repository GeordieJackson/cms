@extends('dashboard.layout')
@section('meta')
    @parent
    @include('dashboard.editor.editor')
@endsection

@section('head')
    <h1 class="text-4xl">Posts management</h1>
@endsection
@section('content')
    @include('dashboard.posts.includes.errors')
    <form class="js-postform" action="{{route('dashboard.posts.store')}}" method="post">
        @csrf
        <div class="post_container">
            <div class="post_container-main">
                <div class="mb-2 w-100">
                    @php
                        $method = 'create';
                    @endphp
                    @include('dashboard.posts.form_partials.options_bar')
                </div>
                @include('dashboard.posts.form_partials.form')
            </div>
            @include('dashboard.posts.form_partials.form_aside')
        </div>
    </form>
@endsection
@section('js')
    @include('dashboard.posts.includes.display_options')
@endsection
