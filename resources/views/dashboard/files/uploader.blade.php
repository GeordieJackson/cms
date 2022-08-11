@extends('dashboard.layout')
@section('head')
    <h1 class="text-4xl">Files uploader</h1>
@endsection
@section('content')
@livewire('files-uploader')
@section('js')
    @parent
@endsection
@endsection

