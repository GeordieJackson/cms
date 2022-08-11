<div class="header">
    <div class="header-logo">
        <img src="/storage/graphics/critical-thinking.png" alt="Logo">
    </div>
    @auth
        <div class="header-nav">
            <ul>
                @can('see.dashboard')
                    <li><a href="{{ route('dashboard.home') }}">Dashboard</a>&nbsp;</li>
                    <li>|</li>
                @endcan
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
                {{--                <li><a href="{{ route('register') }}">Register | </a></li>--}}
            </ul>
        </div>
    @else
        @env('local')
            <div class="header-nav">
                <ul>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        @endenv
    @endauth
</div>

