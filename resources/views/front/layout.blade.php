<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $meta->title ?? 'Critical Thinking UK' }}</title>
    <meta name="description" content="{{ $meta->description ?? '' }}">
    <meta name="keywords" content="{{ $meta->keywords ?? ''  }}">
    <meta name="author" content="{{ $meta->author ?? '' }}">
    <link rel="stylesheet" href="{{ url(mix('css/style.css')) }}">
    @stack('styles')
    @livewireStyles
    <script src="{{ url(mix('js/app.js')) }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="layout">
    <header id="layout-header">
        @include('front.sections.header')
    </header>
    <nav id="layout-nav">
        @include('front.sections.navbar')
    </nav>
    <div id="layout-display">
        @isset($breadcrumb)
            <x-breadcrumb :breadcrumb="$breadcrumb"></x-breadcrumb>
        @endisset
        @yield('display')
    </div>
    <footer id="layout-footer">
        @include('front.sections.footer')
    </footer>
</div>
@stack('scripts')
@livewireScripts
</body>
</html>
