@extends('layouts.app')

@section('content')

<div class="admin-header">
    <a href="{{ route('events.create') }}" class="btn">Добавить программу</a>
</div>

<div class="card-news">
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Описание</th>
                <th>Примечание</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->author ?? '—' }}</td>
                <td>{{ $event->details ?? '—' }}</td>
                <td>{{ $event->note ?? '—' }}</td>
                <td class="actions-cell">
                    <a href="{{ route('events.show', $event) }}" class="action-link">Просмотр</a>
                    <a href="{{ route('events.edit', $event) }}" class="action-link">Редактировать</a>
                    <form method="POST" action="{{ route('events.destroy', $event) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="action-link" onclick="if(confirm('Точно удалить?')) this.closest('form').submit(); return false;">Удалить</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($events->hasPages())
        <div class="custom-pagination">
            {{ $events->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection