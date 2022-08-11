@extends('front.type.right-sidebar')
@section('content')
    <header class="headings-page">
        <div class="headings-page-spacer"></div>
        <div class="headings-page-body">
            <h1>Articles by tag: "{{$tagName ?? ''}}"</h1>
            <div class="headings-page-spacer-b"></div>
        </div>
    </header>
    @include('front.pages.partials.blog_list')
    <div class="text-center">{{ $posts->links() }}</div>
@endsection
