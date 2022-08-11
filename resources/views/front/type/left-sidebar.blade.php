@extends('front.layout')
@section('display')
    <div class="display">

        <x-sidebar class="display-sidebar-left">
            @if(isset($tagList) && $tagList)
                <x-tags :tagList="$tagList"></x-tags>
            @endif
        </x-sidebar>

        <div class="display-content">
            @yield('content')
        </div>

    </div>
@endsection


