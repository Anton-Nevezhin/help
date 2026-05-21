<!DOCTYPE html>
<html>
<head>
    <title>Площадки</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Площадки</h1>
    
    <a href="{{ route('places.create') }}">Добавить площадку</a>
        <a href="{{ route('admin.index') }}">В админку</a>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Название</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
            <tr>
                <td>{{ $place->name }}</td>
                <td>{{ $place->address ?? '—' }}</td>
                <td>{{ $place->phone ?? '—' }}</td>
                <td>
                    <a href="{{ route('places.show', $place) }}">Просмотр</a>
                    <a href="{{ route('places.edit', $place) }}">Редактировать</a>
                    <form method="POST" action="{{ route('places.destroy', $place) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Точно удалить?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($places->hasPages())
    @if ($places->onFirstPage())
        <span>[← Назад]</span>
    @else
        <a href="{{ $places->previousPageUrl() }}&per_page={{ request()->get('per_page', 10) }}">[← Назад]</a>
    @endif
    
    @php
        $currentPage = $places->currentPage();
        $lastPage = $places->lastPage();
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);
    @endphp
    
    @if ($start > 1)
        <a href="{{ $places->url(1) }}&per_page={{ request()->get('per_page', 10) }}">[1]</a>
        @if ($start > 2) <span>...</span> @endif
    @endif
    
    @for ($i = $start; $i <= $end; $i++)
        @if ($i == $currentPage)
            <span><strong>[{{ $i }}]</strong></span>
        @else
            <a href="{{ $places->url($i) }}&per_page={{ request()->get('per_page', 10) }}">[{{ $i }}]</a>
        @endif
    @endfor
    
    @if ($end < $lastPage)
        @if ($end < $lastPage - 1) <span>...</span> @endif
        <a href="{{ $places->url($lastPage) }}&per_page={{ request()->get('per_page', 10) }}">[{{ $lastPage }}]</a>
    @endif
    
    @if ($places->hasMorePages())
        <a href="{{ $places->nextPageUrl() }}&per_page={{ request()->get('per_page', 10) }}">[Вперёд →]</a>
    @else
        <span>[Вперёд →]</span>
    @endif
@endif
</body>
</html>
