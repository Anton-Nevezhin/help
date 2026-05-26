@extends('layouts.app')

@section('content')

<div class="form-card" style="max-width: 800px;">
    @if($meeting->place->name)
        <div class="view-group place-name">{{ $meeting->place->name }}</div>
    @endif
    @if($meeting->place->address)
        <div class="view-group">{{ $meeting->place->address }}</div>
    @endif
    @if($meeting->place->phone)
        <div class="view-group">{{ $meeting->place->phone }}</div>
    @endif
    @if($meeting->event->name)
        <div class="view-group event-name">{{ $meeting->event->name }}</div>
    @endif
    @if($meeting->event->author)
        <div class="view-group">{{ $meeting->event->author }}</div>
    @endif
    @if($meeting->event->details)
        <div class="view-group">{{ $meeting->event->details }}</div>
    @endif
    @if($meeting->event->note)
        <div class="view-group">{{ $meeting->event->note }}</div>
    @endif
    <div class="view-group meeting-datetime">
        {{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }} в {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}
    </div>
    @if($meeting->note)
        <div class="view-group">{{ $meeting->note }}</div>
    @endif

    <div class="form-actions" style="margin-top: 30px;">
        <a href="{{ route('meetings.index') }}" class="btn">Назад</a>
        <a href="{{ route('meetings.edit', $meeting) }}" class="btn">Редактировать</a>
    </div>
</div>

@endsection