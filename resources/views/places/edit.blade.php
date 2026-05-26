@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Редактирование площадки</h1>

    <form method="POST" action="{{ route('places.update', $place) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Название:</label>
            <input type="text" name="name" value="{{ $place->name }}" required>
        </div>

        <div class="form-group">
            <label>Адрес:</label>
            <textarea name="address" rows="3" required>{{ $place->address }}</textarea>
        </div>

        <div class="form-group">
            <label>Телефон:</label>
            <input type="text" name="phone" value="{{ $place->phone }}">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Сохранить</button>
            <a href="{{ route('places.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection