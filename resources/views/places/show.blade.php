@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>{{ $place->name }}</h1>

    <div class="view-group">
        <strong>ID:</strong> <span>{{ $place->id }}</span>
    </div>
    <div class="view-group">
        <strong>Адрес:</strong> <span>{{ $place->address }}</span>
    </div>
    <div class="view-group">
        <strong>Телефон:</strong> <span>{{ $place->phone ?? 'не указан' }}</span>
    </div>

    <div class="form-actions">
        <a href="{{ route('places.index') }}" class="btn">Назад</a>
        <a href="{{ route('places.edit', $place) }}" class="btn">Редактировать</a>
    </div>
</div>

@endsection