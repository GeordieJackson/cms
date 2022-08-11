@extends('front.type.right-sidebar')
@section('content')
    <main>
        <header class="headings-page">
            <div class="headings-page-spacer"></div>
            <div class="headings-page-body">
                <h1>Category: {{$category}}</h1>
                <div class="headings-page-spacer-b"></div>
            </div>
        </header>

            @include('front.pages.partials.blog_list')

    </main>
@endsection
