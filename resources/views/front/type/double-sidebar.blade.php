@extends('front.layout')
@section('display')
    <div class="display">

        <x-sidebar class="display-sidebar-start">
            {{ $primarySidebarContent ?? null }}
        </x-sidebar>

        <div class="display-content">
            @yield('content')
        </div>

        <x-sidebar class="display-sidebar-right">
            @if(isset($tagList) && $tagList)
                <x-tags :tagList="$tagList"></x-tags>
            @endif
        </x-sidebar>

    </div>
@endsection
