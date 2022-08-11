@extends('dashboard.layout')
@section('meta')
@endsection

@section('head')
    <h1 class="text-4xl">Posts management</h1>
@endsection
@section('content')
    <div class="container-xxxl mx-auto">
        <div class="text-right"><a href="{{ route('dashboard.posts.create') }}"><button type="button" class="btn btn-success mb-2">Create new</button></a></div>
        <livewire:posts-management-table></livewire:posts-management-table>
    </div>
@section('js')
    @parent
@endsection
@endsection
