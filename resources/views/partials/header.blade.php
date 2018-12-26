<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">Nexo Bank</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">Home</a></li>
            @if(Auth::check())
                <li><a href="{{ route('deposit') }}">Deposit</a></li>
            @endif
        </ul>
        @if(Auth::check())
            <ul class="nav navbar-nav pull-right">
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        @else
            <ul class="nav navbar-nav pull-right">
                <li><a href="{{ route('login') }}">Sign in</a></li>
            </ul>
        @endif
    </div>
</nav>