<h1>User Profile</h1>

<p>Name: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>

<a href="{{ route('home') }}">Back to home</a>