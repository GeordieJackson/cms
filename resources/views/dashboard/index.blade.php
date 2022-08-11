@extends('dashboard.layout')
@section('content')
    <div class="flex wrap justify-between">
        <div class="dashbox-4">
            <div class="dashbox-icon"><span class="icon-stack fa-4x dashbox-4--icon"></span></div>
            <div class="dashbox-message">
                <p class="dashbox-message--title">Posts</p>
                <p>Posts in the system</p>
            </div>
            <div class="dashbox-data">{{ $postCount }}</div>
        </div>
        <div class="dashbox-1">
            <div class="dashbox-icon"><span class="icon-stack fa-4x dashbox-1--icon"></span></div>
            <div class="dashbox-message">
                <p class="dashbox-message--title">Active Posts</p>
                <p>Active posts in the system</p>
            </div>
            <div class="dashbox-data">{{ $activePostCount }}</div>
        </div>
        <div class="dashbox-2">
            <div class="dashbox-icon"><span class="icon-users dashbox-2--icon"></span></div>
            <div class="dashbox-message">
                <p class="dashbox-message--title">Current users</p>
                <p>The number of registered users</p>
            </div>
            <div class="dashbox-data">{{ $userCount }}</div>
        </div>
        <div class="dashbox-3">
            <div class="dashbox-icon"><span class="icon-drawer dashbox-3--icon"></span></div>
            <div class="dashbox-message">
                <p class="dashbox-message--title">Categories</p>
                <p>The number of categories in the system</p>
            </div>
            <div class="dashbox-data">{{ $categoriesCount }}</div>
        </div>
    </div>
@endsection
