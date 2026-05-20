<!DOCTYPE html>
<html>
<head>
    <title>Редактирование события</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Редактирование события: {{ $meeting->name }}</h1>
    
    <form method="POST" action="{{ route('meetings.update', $meeting) }}">
        @csrf
        @method('PUT')
        
        <div>
            <label>Учреждение:</label><br>
            <select name="place_id" required>
                @foreach($places as $place)
                    <option value="{{ $place->id }}" {{ $meeting->place_id == $place->id ? 'selected' : '' }}>
                        {{ $place->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Мероприятие:</label><br>
            <select name="event_id" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $meeting->event_id == $event->id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>
        </div>
               
        <div>
            <label>Дата:</label><br>
            <input type="date" name="meeting_date" value="{{ $meeting->meeting_date }}" required>
        </div>
        
        <div>
            <label>Время:</label><br>
            <input type="time" name="meeting_time" value="{{ $meeting->meeting_time }}" required>
        </div>
        
        <div>
            <label>Примечание:</label><br>
            <textarea name="note" rows="4" cols="50">{{ $meeting->note }}</textarea>
        </div>
        
        <button type="submit">Сохранить изменения</button>
        <a href="{{ route('meetings.index') }}">Отмена</a>
    </form>
</body>
</html>
