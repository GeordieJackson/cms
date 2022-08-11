<div class="navbar-menu">
    <div class="menu-large">
        <ul>
            {!! $pageLinks !!}
{{--            <li><a href="{{route('home')}}">Home</a></li>--}}
{{--            @foreach($pages as $page)--}}
{{--                <li><a href="{{route('post', $page->slug)}}">{{$page->title}}</a></li>--}}
{{--            @endforeach--}}
            @if($categoryMenu)
                <li><a>Categories</a>
                    {!! $categoryMenu !!}
                </li>
            @endif
            {!! $temporalLinks !!}
{{--            @foreach($temporalLinks as $link)--}}
{{--                <li><a href="/{{$link->slug}}">{{display($link->name, 'f')}}</a></li>--}}
{{--            @endforeach--}}
        </ul>
    </div>

    <div
            x-data="{ display: false}"
            x-init="$refs.menu.classList.remove('hidden')"
            x-on:click.away="display = false"
            class="navbar-hamburger"
    >
        <div><span x-on:click="display = ! display" class="hamburger icon-menu"></span></div>
        <div>Menu</div>
        <div
                x-ref="menu"
                x-show="display"
                class="menu-small hidden">
            <ul>
                {!! $pageLinks !!}
{{--                <li><a href="{{route('home')}}">Home</a></li>--}}
{{--                @foreach($pages as $page)--}}
{{--                    <li><a href="{{route('post', $page->slug)}}">{{$page->title}}</a></li>--}}
{{--                @endforeach--}}
                @if($categoryMenu)
                    <li><a href="/categories">Categories</a>
                        {!! $categoryMenu !!}
                    </li>
                @endif
                {!! $temporalLinks !!}
            </ul>
        </div>
    </div>

    <form class="search-nav" action="{{ route('search') }}" method="post">
        @csrf
        <span class="icon-search"></span>
        <input name="searchTerm" type="search">
        <button>Search</button>
    </form>
</div>
