<nav class="navbar">
    <div class="container">
        <div class="logo">CRM</div>
        <div class="nav-links">
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
                    <button type="submit" class="btn-logout">Выйти</button>
                </form>
            @endauth
        </div>
    </div>
</nav>