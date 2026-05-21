<!DOCTYPE html>
<html>
<head>
    <title>Новый участник</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Новый участник</h1>
    
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        
        <div>
            <label>Имя:</label><br>
            <input type="text" name="name" required>
        </div>
        
        <div>
            <label>Email:</label><br>
            <input type="email" name="email">
        </div>
        
        <div>
            <label>Телефон:</label><br>
            <input type="text" name="phone" required>
        </div>
        
        <div>
            <label>Телеграм:</label><br>
            <input type="text" name="telegram_id">
        </div>

        <div>
            <label>Вацап:</label><br>
            <input type="text" name="whatsapp_phone">
        </div>

        <div>
            <label>Вконтакте:</label><br>
            <input type="text" name="vk_id">
        </div>

        
        <button type="submit">Создать</button>
        <a href="{{ route('users.index') }}">Отмена</a>
    </form>
</body>
</html>
