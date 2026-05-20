<nav class="navbar">
    <div class="container">
        <div class="logo">CRM</div>
        <div class="nav-links">
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
                    <button type="submit" class="btn-logout">Выйти</button>
                </form>
            @endauth
        </div>
    </div>
</nav>