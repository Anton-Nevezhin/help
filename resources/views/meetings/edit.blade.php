@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Редактирование мероприятия</h1>

    <form method="POST" action="{{ route('meetings.update', $meeting) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Площадка:</label>
            <select name="place_id" required>
                @foreach($places as $place)
                    <option value="{{ $place->id }}" {{ $meeting->place_id == $place->id ? 'selected' : '' }}>
                        {{ $place->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Программа:</label>
            <select name="event_id" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $meeting->event_id == $event->id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Дата:</label>
            <input type="date" name="meeting_date" value="{{ $meeting->meeting_date }}" required>
        </div>

        <div class="form-group">
            <label>Время:</label>
            <input type="time" name="meeting_time" value="{{ $meeting->meeting_time }}" required>
        </div>

        <div class="form-group">
            <label>Примечание:</label>
            <textarea name="note" rows="3">{{ $meeting->note }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Сохранить изменения</button>
            <a href="{{ route('meetings.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

@endsection