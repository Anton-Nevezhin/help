<!DOCTYPE html>
<html>
<head>
    <title>{{ $place->name }}</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>{{ $place->name }}</h1>
    
    <p><strong>ID:</strong> {{ $place->id }}</p>
    <p><strong>Адрес:</strong> {{ $place->address }}</p>
    <p><strong>Телефон:</strong> {{ $place->phone ?? 'не указан' }}</p>


    
    <a href="{{ route('places.index') }}">Назад к списку</a>
    <a href="{{ route('places.edit', $place) }}">Редактировать</a>
</body>
</html>
