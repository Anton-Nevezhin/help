@extends('layouts.app')

@section('content')

<div class="form-card" style="max-width: 800px;">
    @if($event->name)
        <div class="view-group event-name">{{ $event->name }}</div>
    @endif
    @if($event->author)
        <div class="view-group">{{ $event->author }}</div>
    @endif
    @if($event->details)
        <div class="view-group">{{ $event->details }}</div>
    @endif
    @if($event->note)
        <div class="view-group">{{ $event->note }}</div>
    @endif

    <div class="form-actions" style="margin-top: 30px;">
        <a href="{{ route('events.index') }}" class="btn">Назад</a>
        <a href="{{ route('events.edit', $event) }}" class="btn">Редактировать</a>
    </div>
</div>

@endsection