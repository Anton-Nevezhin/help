@extends('layouts.app')

@section('content')
<h1>Личный кабинет</h1>

<h2>Настройки уведомлений</h2>
<form method="POST" action="{{ route('cabinet.update') }}">
    @csrf
    @method('PUT')

<!-- кнопка для регистрации в телеграм (для сервера в сети)
    <div>
    <label>Telegram:</label>
    @if(auth()->user()->telegram_id)
        <p style="color: green;">✓ Telegram привязан (ID: {{ auth()->user()->telegram_id }})</p>
    @else
        {{-- КОГДА ЗАЛЬЁШЬ НА СЕРВЕР С HTTPS — РАСКОММЕНТИРУЙ ЭТОТ БЛОК, А ПОЛЕ ВВОДА УДАЛИ --}}
        {{--
        <script async src="https://telegram.org/js/telegram-widget.js?22" 
            data-telegram-login="{{ env('TELEGRAM_BOT_NAME') }}" 
            data-size="large" 
            data-auth-url="{{ route('telegram.callback') }}" 
            data-request-access="write">
        </script>
        --}}
        
        {{-- ВРЕМЕННО НА ЛОКАЛКЕ ОСТАВЛЯЕМ РУЧНОЙ ВВОД --}}
        <input type="text" name="telegram_id" placeholder="Введите ID вручную" value="{{ old('telegram_id', auth()->user()->telegram_id) }}">
        <small><a href="https://t.me/userinfobot" target="_blank">Узнать свой ID</a></small>
    @endif
</div>-->

    <div>
        <label>Telegram ID:</label>
        <input type="text" name="telegram_id" value="{{ old('telegram_id', auth()->user() ? auth()->user()->telegram_id : '') }}">
    </div>
    <div>
        <label>WhatsApp номер:</label>
        <input type="text" name="whatsapp_phone" value="{{ old('whatsapp_phone', auth()->user() ? auth()->user()->whatsapp_phone : '') }}">
    </div>
    <div>
        <label>VK ID:</label>
        <input type="text" name="vk_id" value="{{ old('vk_id', auth()->user() ? auth()->user()->vk_id : '') }}">
    </div>
    <button type="submit">Сохранить</button>
</form>

<h2>Новости</h2>
@foreach($posts as $post)
    <div style="margin-bottom: 20px;">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <hr>
    </div>
@endforeach

<h2>Актуальные программы</h2>
@foreach($meetings as $meeting)
    <div>
        <strong>{{ $meeting->event->name ?? '—' }}</strong> –
        {{ $meeting->place->name ?? '—' }},
        {{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }}
        в {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}
        @if($meeting->note)
            <br><small>{{ $meeting->note }}</small>
        @endif
    </div>
@endforeach
@endsection