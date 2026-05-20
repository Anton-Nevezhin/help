<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Help')</title>
    <meta charset="utf-8">
</head>
<body>
    <nav>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.index') }}">Админка</a>
                <a href="{{ route('places.index') }}">Места</a>
                <a href="{{ route('events.index') }}">Мероприятия</a>
                <a href="{{ route('meetings.index') }}">Расписание</a>
                <a href="{{ route('users.index') }}">Пользователи</a>
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
</body>
</html>