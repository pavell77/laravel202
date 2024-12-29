<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        @auth
            <a href="{{ route('logout') }}">Logout</a>
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