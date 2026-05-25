@extends('layouts.app')

@section('content')

<h2>Настройки уведомлений</h2>
<div class="card-news">
    <form method="POST" action="{{ route('cabinet.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Telegram:</label>
            @if(auth()->user()->telegram_id)
                <button type="button" class="btn" disabled>Telegram привязан</button>
            @else
                <button type="button" id="bindTelegramBtn" class="btn">Привязать Telegram</button>
            @endif
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
        </div>

        <button type="submit" class="btn">Сохранить</button>
    </form>
</div>

@foreach($posts as $post)
    <div class="card-news">
        <div class="post-title" style="font-weight: bold; font-size: 22px;">{{ $post->title }}</div>
        <div>{{ $post->content }}</div>
    </div>
@endforeach

@foreach($meetings as $meeting)
    <div class="card-meeting">
        @if($meeting->place->name)
            <div class="place-name">{{ $meeting->place->name }}</div>
        @endif
        @if($meeting->place->address)
            <div>{{ $meeting->place->address }}</div>
        @endif
        @if($meeting->place->phone)
            <div>{{ $meeting->place->phone }}</div>
        @endif
        @if($meeting->event->name)
            <div class="event-name">{{ $meeting->event->name }}</div>
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
        <div class="meeting-datetime">{{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }} в {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}</div>
        @if($meeting->note)
            <div>{{ $meeting->note }}</div>
        @endif
    </div>
@endforeach
@endsection