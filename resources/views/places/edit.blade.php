DOCTYPE html>
<html>
<head>
    <title>Редактирование учреждения</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>{{ $place->name }}</h1>
    
    <form method="POST" action="{{ route('places.update', $place) }}">
        @csrf
        @method('PUT')
        
        <div>
            <label>Название:</label><br>
            <input type="text" name="name" value="{{ $place->name }}" required>
        </div>
        
        <div>
            <label>Адрес:</label><br>
            <textarea name="address">{{ $place->address }}</textarea>
        </div>
        
        <div>
            <label>Телефон:</label><br>
            <input type="text" name="phone" value="{{ $place->phone }}">
        </div>  
        
        <button type="submit">Сохранить</button>
        <a href="{{ route('places.index') }}">Отмена</a>
    </form>
</body>
</html>
