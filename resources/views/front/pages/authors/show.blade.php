@extends('front.type.right-sidebar')
@section('content')
    <header class="headings-page">
        <div class="headings-page-spacer"></div>
        <div class="headings-page-body">
            <h1>Articles by: {{$author->name ?? ''}}</h1>
            <div class="headings-page-spacer-b"></div>
        </div>
    </header>
    <livewire:article-list :author="$author"></livewire:article-list>
@endsection
