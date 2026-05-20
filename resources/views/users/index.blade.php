<!DOCTYPE html>
<html>
<head>
    <title>Пользователи</title>
    <meta charset="utf-8">
</head>
<body>

    @if(session('error'))
        <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Список пользователей</h1>
    
    <a href="{{ route('users.create') }}">Добавить пользователя</a>
    <a href="{{ route('admin.index') }}">В админку</a>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Пароль</th>
                <th>Телефон</th>
                <th>Телеграм</th>
                <th>Вацап</th>
                <th>Вконтакте</th>
                <th>Права</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email ?? '—' }}</td>
                <td>{{ $user->password}}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->telegram_id ?? '—' }}</td>
                <td>{{ $user->whatsapp_phone ?? '—' }}</td>
                <td>{{ $user->vk_id ?? '—' }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.show', $user) }}">Просмотр</a>
                    <a href="{{ route('users.edit', $user) }}">Редактировать</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Точно удалить?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($users->hasPages())
    @if ($users->onFirstPage())
        <span>[← Назад]</span>
    @else
        <a href="{{ $users->previousPageUrl() }}&per_page={{ request()->get('per_page', 10) }}">[← Назад]</a>
    @endif
    
    @php
        $currentPage = $users->currentPage();
        $lastPage = $users->lastPage();
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);
    @endphp
    
    @if ($start > 1)
        <a href="{{ $users->url(1) }}&per_page={{ request()->get('per_page', 10) }}">[1]</a>
        @if ($start > 2) <span>...</span> @endif
    @endif
    
    @for ($i = $start; $i <= $end; $i++)
        @if ($i == $currentPage)
            <span><strong>[{{ $i }}]</strong></span>
        @else
            <a href="{{ $users->url($i) }}&per_page={{ request()->get('per_page', 10) }}">[{{ $i }}]</a>
        @endif
    @endfor
    
    @if ($end < $lastPage)
        @if ($end < $lastPage - 1) <span>...</span> @endif
        <a href="{{ $users->url($lastPage) }}&per_page={{ request()->get('per_page', 10) }}">[{{ $lastPage }}]</a>
    @endif
    
    @if ($users->hasMorePages())
        <a href="{{ $users->nextPageUrl() }}&per_page={{ request()->get('per_page', 10) }}">[Вперёд →]</a>
    @else
        <span>[Вперёд →]</span>
    @endif
@endif
    
</body>
</html>
