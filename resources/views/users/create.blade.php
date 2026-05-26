@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Новый участник</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email">
        </div>

        <div class="form-group">
            <label>Телефон:</label>
            <input type="text" name="phone" required>
        </div>

        <div class="form-group">
            <label>Telegram ID:</label>
            <input type="text" name="telegram_id">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Создать</button>
            <a href="{{ route('users.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection