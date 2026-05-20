<!DOCTYPE html>
<html>
<head>
    <title>{{ $meeting->name }}</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>{{ $meeting->name }}</h1>
    
    <p><strong>{{ $meeting->place->name }}</strong></p>
    <p><strong>{{ $meeting->place->address }}</strong></p>
    <p><strong>{{ $meeting->event->name }}</strong></p>
    <p><strong>{{ $meeting->event->author }}</strong></p>
    <p><strong>{{ $meeting->event->details }}</strong></p>
    <p><strong>{{ $meeting->event->note }}</strong></p>
    <p><strong>Дата: {{ $meeting->meeting_date }}</strong></p>
    <p><strong>Время: {{ $meeting->meeting_time }}</strong></p>
    <p><strong>{{ $meeting->note }}</strong></p>
    
    <a href="{{ route('meetings.index') }}">Назад к списку</a>
    <a href="{{ route('meetings.edit', $meeting) }}">Редактировать</a>
</body>
</html>
