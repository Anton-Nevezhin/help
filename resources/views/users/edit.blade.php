<!DOCTYPE html>
<html>
<head>
    <title>Редактирование клиента</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Редактирование клиента: {{ $user->name }}</h1>
    
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')
        
        <div>
            <label>Имя:</label><br>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>
        
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>
        
        <div>
            <label>Телефон:</label><br>
            <input type="text" name="phone" value="{{ $user->phone }}">
        </div>
        
        <div>
            <label>Телеграм:</label><br>
            <input type="text" name="telegram_id" value="{{ $user->telegram_id }}">
        </div>

        <div>
            <label>Вацап:</label><br>
            <input type="text" name="whatsapp_phone" value="{{ $user->whatsapp_phone }}">
        </div>

        <div>
            <label>Вконтакте:</label><br>
            <input type="text" name="vk_id" value="{{ $user->vk_id }}">
        </div>

        <div>
            <label>Права:</label><br>
            <select name="role">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Пользователь</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Администратор</option>
            </select>
        </div>
       
        <button type="submit">Сохранить</button>
        <a href="{{ route('users.index') }}">Отмена</a>
    </form>
</body>
</html>
