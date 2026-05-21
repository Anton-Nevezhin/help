<!DOCTYPE html>
<html>
<head>
    <title>Программы</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Программы</h1>
    
    <a href="{{ route('events.create') }}">Добавить программу</a>
        <a href="{{ route('admin.index') }}">В админку</a>
    
    <table border="1" cellpadding="10">
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
                <td>
                    <a href="{{ route('events.show', $event) }}">Просмотр</a>
                    <a href="{{ route('events.edit', $event) }}">Редактировать</a>
                    <form method="POST" action="{{ route('events.destroy', $event) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Точно удалить?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
