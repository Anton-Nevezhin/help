<!DOCTYPE html>
<html>
<head>
    <title>События</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Список событий</h1>
    
    <a href="{{ route('meetings.create') }}">Добавить событие</a>
    <a href="{{ route('admin.index') }}">В админку</a>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Учреждение</th>
                <th>Мероприятие</th>
                <th>Дата</th>
                <th>Время</th>
                <th>Примечание</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meetings as $meeting)
            <tr>
                <td>{{ $meeting->id }}</td>
                <td>{{ $meeting->place->name }}</td>
                <td>{{ $meeting->event->name }}</td>
                <td>{{ $meeting->meeting_date }}</td>
                <td>{{ $meeting->meeting_time }}</td>
                <td>{{ $meeting->note }}</td>
                <td>
                    <a href="{{ route('meetings.show', $meeting) }}">Просмотр</a>
                    <a href="{{ route('meetings.edit', $meeting) }}">Редактировать</a>
                    <form method="POST" action="{{ route('meetings.destroy', $meeting) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Точно удалить?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($meetings->hasPages())
    @if ($meetings->onFirstPage())
        <span>[← Назад]</span>
    @else
        <a href="{{ $meetings->previousPageUrl() }}&per_page={{ request()->get('per_page', 10) }}">[← Назад]</a>
    @endif
    
    @php
        $currentPage = $meetings->currentPage();
        $lastPage = $meetings->lastPage();
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);
    @endphp
    
    @if ($start > 1)
        <a href="{{ $meetings->url(1) }}&per_page={{ request()->get('per_page', 10) }}">[1]</a>
        @if ($start > 2) <span>...</span> @endif
    @endif
    
    @for ($i = $start; $i <= $end; $i++)
        @if ($i == $currentPage)
            <span><strong>[{{ $i }}]</strong></span>
        @else
            <a href="{{ $meetings->url($i) }}&per_page={{ request()->get('per_page', 10) }}">[{{ $i }}]</a>
        @endif
    @endfor
    
    @if ($end < $lastPage)
        @if ($end < $lastPage - 1) <span>...</span> @endif
        <a href="{{ $meetings->url($lastPage) }}&per_page={{ request()->get('per_page', 10) }}">[{{ $lastPage }}]</a>
    @endif
    
    @if ($meetings->hasMorePages())
        <a href="{{ $meetings->nextPageUrl() }}&per_page={{ request()->get('per_page', 10) }}">[Вперёд →]</a>
    @else
        <span>[Вперёд →]</span>
    @endif
@endif


</body>
</html>
