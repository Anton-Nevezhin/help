@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Редактирование программы</h1>

    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Название:</label>
            <input type="text" name="name" value="{{ $event->name }}" required>
        </div>

        <div class="form-group">
            <label>Автор:</label>
            <input type="text" name="author" value="{{ $event->author }}" required>
        </div>

        <div class="form-group">
            <label>Описание:</label>
            <textarea name="details" rows="3">{{ $event->details }}</textarea>
        </div>

        <div class="form-group">
            <label>Примечание:</label>
            <textarea name="note" rows="2">{{ $event->note }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Сохранить</button>
            <a href="{{ route('events.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection