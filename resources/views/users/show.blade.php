@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>{{ $user->name }}</h1>

    <div class="view-group">
        <strong>Имя:</strong> <span>{{ $user->name }}</span>
    </div>
    <div class="view-group">
        <strong>Email:</strong> <span>{{ $user->email ?? '—' }}</span>
    </div>
    <div class="view-group">
        <strong>Телефон:</strong> <span>{{ $user->phone }}</span>
    </div>
    <div class="view-group">
        <strong>Telegram ID:</strong> <span>{{ $user->telegram_id ?? '—' }}</span>
    </div>
    <div class="view-group">
        <strong>Права:</strong> <span>{{ $user->role }}</span>
    </div>

    <div class="form-actions">
        <a href="{{ route('users.index') }}" class="btn">Назад</a>
        <a href="{{ route('users.edit', $user) }}" class="btn">Редактировать</a>
    </div>
</div>

@endsection