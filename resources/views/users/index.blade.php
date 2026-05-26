@extends('layouts.app')

@section('content')

<div class="admin-header">
    <a href="{{ route('users.create') }}" class="btn">Добавить участника</a>
    <a href="{{ route('admin.index') }}" class="btn">В админку</a>
</div>

@if(session('error'))
    <div class="alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="card-news">
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Телеграм</th>
                <th>Права</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email ?? '—' }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->telegram_id ?? '—' }}</td>
                <td>{{ $user->role }}</td>
                <td class="actions-cell">
                    <a href="{{ route('users.show', $user) }}" class="action-link">Просмотр</a>
                    <a href="{{ route('users.edit', $user) }}" class="action-link">Редактировать</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="action-link" onclick="if(confirm('Точно удалить?')) this.closest('form').submit(); return false;">Удалить</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($users->hasPages())
        <div class="custom-pagination">
            {{ $users->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection