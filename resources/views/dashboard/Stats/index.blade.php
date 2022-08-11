@extends('dashboard.layout')
@section('head')
    <h1 class="text-4xl">Visitor statistics</h1>
@endsection
@section('content')
@livewire('stats')
@section('js')
    @parent
@endsection
@endsection
