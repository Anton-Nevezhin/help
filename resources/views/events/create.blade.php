@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Новая программа</h1>

    <form method="POST" action="{{ route('events.store') }}">
        @csrf

        <div class="form-group">
            <label>Название:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Автор:</label>
            <input type="text" name="author" required>
        </div>

        <div class="form-group">
            <label>Описание:</label>
            <textarea name="details" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Примечание:</label>
            <textarea name="note" rows="2"></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Создать</button>
            <a href="{{ route('events.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection