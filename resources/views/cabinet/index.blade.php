@extends('layouts.app')

@section('content')
<h1>Личный кабинет</h1>

<h2>Настройки уведомлений</h2>
<form method="POST" action="{{ route('cabinet.update') }}">
    @csrf
    @method('PUT')
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