<div class="actions">
    <ul>
        @can('see.dashboard')
            <li><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
        @endcan
        @if(Auth::check())
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('register') }}">Register</a>
            </li>
            <li>
                <a href="{{ route('login') }}">Login <span class="fa fa-sign-in-alt"></span></a>
            </li>
        @endif
    </ul>
</div>
