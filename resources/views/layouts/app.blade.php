<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>