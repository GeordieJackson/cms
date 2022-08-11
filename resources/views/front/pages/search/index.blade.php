@extends('front.type.right-sidebar')
@section('content')
    <header class="headings-page mt-8">
        <div class="headings-page-spacer"></div>
        <div class="headings-page-body">
            <h1>Search...</h1>
            <div class="headings-page-spacer-b"></div>
        </div>
    </header>
    <div class="container-md mx-auto">
        @livewire('search-form', ['searchTerm' => $searchTerm])
    </div>
@endsection