<!DOCTYPE html>
<html>
<head>
    <title>Новая программа</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Новая программа</h1>
    
    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        
        <div>
            <label>Название:</label><br>
            <input type="text" name="name" required>
        </div>
        
        <div>
            <label>Автор:</label><br>
            <input type="text" name="author" required>
        </div>
        
        <div>
            <label>Описание:</label><br>
            <input type="text" name="details">
        </div>
        
        <div>
            <label>Примечание:</label><br>
            <textarea name="note"></textarea>
        </div>
        
        <button type="submit">Создать</button>
        <a href="{{ route('events.index') }}">Отмена</a>
    </form>
</body>
</html>
