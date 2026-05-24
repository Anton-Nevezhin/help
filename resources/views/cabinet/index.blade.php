@extends('layouts.app')

@section('content')

<h2>Настройки уведомлений</h2>
<form method="POST" action="{{ route('cabinet.update') }}">
    @csrf
    @method('PUT')

    <div>
        <label>Telegram:</label>
        @if(auth()->user()->telegram_id)
            <button type="button" disabled>Telegram привязан</button>
        @else
            <button type="button" id="bindTelegramBtn">Привязать Telegram</button>
        @endif
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
    </div>

    <button type="submit">Сохранить</button>
</form>

@foreach($posts as $post)
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <div>{{ $post->title }}</div>
        <div>{{ $post->content }}</div>
    </div>
@endforeach

@foreach($meetings as $meeting)
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        @if($meeting->place->name)
            <div>{{ $meeting->place->name }}</div>
        @endif
        @if($meeting->place->address)
            <div>{{ $meeting->place->address }}</div>
        @endif
        @if($meeting->place->phone)
            <div>{{ $meeting->place->phone }}</div>
        @endif
        @if($meeting->event->name)
            <div>{{ $meeting->event->name }}</div>
        @endif
        @if($meeting->event->author)
            <div>{{ $meeting->event->author }}</div>
        @endif
        @if($meeting->event->details)
            <div>{{ $meeting->event->details }}</div>
        @endif
        @if($meeting->event->note)
            <div>{{ $meeting->event->note }}</div>
        @endif
        <div>{{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }} в {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}</div>
        @if($meeting->note)
            <div>{{ $meeting->note }}</div>
        @endif
    </div>
@endforeach
@endsection