<!DOCTYPE html>
<html>
<head>
    <title>Редактирование мероприятия</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Редактирование мероприятия: {{ $event->name }}</h1>
    
    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf
        @method('PUT')
        
        <div>
            <label>Название:</label><br>
            <input type="text" name="name" value="{{ $event->name }}" required>
        </div>
        
        <div>
            <label>Автор:</label><br>
            <input type="text" name="author" value="{{ $event->author }}" required>
        </div>
        
        <div>
            <label>Описание:</label><br>
            <input type="text" name="details" value="{{ $event->details }}">
        </div>
        
        <div>
            <label>Примечание:</label><br>
            <textarea name="note">{{ $event->note }}</textarea>
        </div>
        
        <button type="submit">Сохранить</button>
        <a href="{{ route('events.index') }}">Отмена</a>
    </form>
</body>
</html>
