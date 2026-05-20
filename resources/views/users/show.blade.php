<!DOCTYPE html>
<html>
<head>
    <title>Сделка {{ $user->name }}</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Сделка: {{ $user->name }}</h1>
    
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Имя:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Пароль:</strong> {{ $user->password }}</p>
    <p><strong>Телефон:</strong> {{ $user->phone }}</p>
    <p><strong>Телеграм:</strong> {{ $user->telegram_id }}</p>
    <p><strong>Вацап:</strong> {{ $user->whatsapp_phone }}</p>
    <p><strong>Вконтакте:</strong> {{ $user->vk_id }}</p>
    <p><strong>Права:</strong> {{ $user->role }}</p>
    <a href="{{ route('users.index') }}">Назад к списку</a>
    <a href="{{ route('users.edit', $user) }}">Редактировать</a>
</body>
</html>