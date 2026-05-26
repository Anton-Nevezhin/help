@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Новая площадка</h1>

    <form method="POST" action="{{ route('places.store') }}">
        @csrf

        <div class="form-group">
            <label>Наименование:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Адрес:</label>
            <textarea name="address" rows="3" required>{{ old('address') }}</textarea>
        </div>

        <div class="form-group">
            <label>Телефон:</label>
            <input type="text" name="phone">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Создать</button>
            <a href="{{ route('places.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection