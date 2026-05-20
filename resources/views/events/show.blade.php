<!DOCTYPE html>
<html>
<head>
    <title>Клиент: {{ $event->name }}</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>{{ $event->name }}</h1>
    
    <p><strong>ID:</strong> {{ $event->id }}</p>
    <p><strong>Название:</strong> {{ $event->name }}</p>
    <p><strong>Автор:</strong> {{ $event->author ?? '-' }}</p>
    <p><strong>Описание:</strong> {{ $event->details ?? '-' }}</p>
    <p><strong>Примечание:</strong> {{ $event->note ?? '-' }}</p>
    
    <a href="{{ route('events.index') }}">Назад к списку</a>
    <a href="{{ route('events.edit', $event) }}">Редактировать</a>
</body>
</html>
