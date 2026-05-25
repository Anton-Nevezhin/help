<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Help')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <nav>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}">Админка</a>
                    <a href="{{ route('places.index') }}">Площадки</a>
                    <a href="{{ route('events.index') }}">Программы</a>
                    <a href="{{ route('meetings.index') }}">Расписание</a>
                    <a href="{{ route('users.index') }}">Участники</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            @endauth
        </nav>

        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>