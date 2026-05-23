<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    
    <form method="POST" action="{{ route('register.phone') }}">
        @csrf
        
        <div>
            <label>Телефон:</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required>
            @error('phone') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label>Пароль:</label>
            <input type="password" name="password" required>
        </div>
        
        <div>
            <label>Подтвердите пароль:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        
        <button type="submit">Зарегистрироваться</button>
    </form>
    
    <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
</body>
</html>