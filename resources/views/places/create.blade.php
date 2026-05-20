<!DOCTYPE html>
<html>
<head>
    <title>Новое учреждение</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Добавление нового учреждения</h1>
    
    <form method="POST" action="{{ route('places.store') }}">
        @csrf
        
        <div>
            <label>Наименование:</label><br>
            <input type="text" name="name" required>

        </div>
        
        <div>
            <label>Адрес:</label><br>
            <input type="text" name="address" required>
        </div>
        
        <div>
            <label>Телефон:</label><br>
            <input type="text" name="phone">
        </div>
        
        <button type="submit">Создать</button>
        <a href="{{ route('places.index') }}">Отмена</a>
    </form>
    
</body>
</html>
