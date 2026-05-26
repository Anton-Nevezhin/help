@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Редактирование</h1>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label>Телефон:</label>
            <input type="text" name="phone" value="{{ $user->phone }}">
        </div>

        <div class="form-group">
            <label>Telegram ID:</label>
            <input type="text" name="telegram_id" value="{{ $user->telegram_id }}">
        </div>

        <div class="form-group">
            <label>Права:</label>
            <select name="role">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Участник</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Администратор</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Сохранить</button>
            <a href="{{ route('users.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection