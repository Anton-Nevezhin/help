@extends('layouts.app')

@section('content')

<div class="admin-header">
    <a href="{{ route('meetings.create') }}" class="btn">Добавить мероприятие</a>
</div>

<div class="card-news">
    <table>
        <thead>
            <tr>
                <th>Площадка</th>
                <th>Программа</th>
                <th>Дата</th>
                <th>Время</th>
                <th>Примечание</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meetings as $meeting)
            <tr>
                <td>{{ $meeting->place->name }}</td>
                <td>{{ $meeting->event->name }}</td>
                <td>{{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}</td>
                <td>{{ $meeting->note ?? '—' }}</td>
                <td class="actions-cell">
                    <a href="{{ route('meetings.show', $meeting) }}" class="action-link">Просмотр</a>
                    <a href="{{ route('meetings.edit', $meeting) }}" class="action-link">Редактировать</a>
                    <form method="POST" action="{{ route('meetings.destroy', $meeting) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="action-link" onclick="if(confirm('Точно удалить?')) this.closest('form').submit(); return false;">Удалить</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($meetings->hasPages())
        <div class="custom-pagination">
            {{ $meetings->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection