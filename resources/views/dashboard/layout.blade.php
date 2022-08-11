<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $meta->title ?? '' }}</title>
    <meta name="description" content="{{ $meta->description ?? '' }}">
    <meta name="keywords" content="{{ $meta->keywords ?? ''  }}">
    <meta name="author" content="{{ $meta->author ?? '' }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/dt-1.10.20/r-2.2.3/sl-1.3.1/datatables.min.css"/>
    <link href="{{ mix('/css/admin.css') }}" rel="stylesheet">
    @yield('meta')
    @livewireStyles
</head>
<body>
<div class="layout">
    <nav class="layout-nav menu_vertical">
        <ul>
            <li><a href="{{ route('dashboard.home') }}"><span class="icon-home"></span>Home</a></li>
            @can('manage.posts')
                <li><a href="{{ route('dashboard.posts.index') }}"><span class="icon-stack"></span>Posts</a></li>
            @endcan

            @can('manage.categories')
                <li><a href="{{ route('dashboard.categories.index') }}"><span class="icon-drawer"></span>Categories</a>
                </li>
                <li><a href="{{route('dashboard.temporalNames.index')}}"><span class="icon-drawer"></span>Temporal
                        sections</a></li>
            @endcan
            @can('manage.acl')
                <li><a><span class="icon-forward"></span>Acl</a>
                    <ul>
                        <li><a href="{{ route('dashboard.assign.index') }}">Assignments</a></li>
                        <li><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
                        <li><a href="{{ route('dashboard.permissions.index') }}">Permissions</a></li>
                    </ul>
                </li>
            @endcan

            <li><a href="{{route('dashboard.users.edit', auth()->id())}}"><span class="icon-user"></span>Profile</a>
            </li>


            @can('update.users')
                <li><a href="{{route('dashboard.users.index')}}"><span class="icon-users"></span>Users</a></li>
            @endcan

            @can('see.stats')
                <li><a href="{{ route('dashboard.stats.index') }}"><span class="icon-sort-numeric-asc"></span>Visitor stats</a></li>
            @endcan

            @can('manage.posts')
                <li><a href="{{ route('dashboard.image_uploader') }}"><span class="icon-newspaper"></span>Images</a>
                </li>
            @endcan
        </ul>
    </nav>
    <div class="layout-display">
        <div class="layout-display-powerbar">
            Welcome, {{auth()->user()->forename}} &nbsp;
            <a href="{{ route('home') }}">
                <button class="btn-xs btn-primary">Home page</button>
            </a>&nbsp;
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn-xs btn-success">Logout</button>&nbsp;
            </form>
        </div>
        <div class="layout-display-head">
            @yield('head')

            <x-alert/>

        </div>

        <div class="layout-display-body">
            @yield('content')
        </div>
    </div>
</div>
@livewireScripts
<script src="{{ mix('/js/app-admin.js') }}"></script>
@yield('js')
</body>
</html>
