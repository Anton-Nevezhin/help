@extends('layouts.app')

@section('content')

<div class="admin-header">
    <a href="{{ route('places.create') }}" class="btn">Добавить площадку</a>
</div>

<div class="card-news">
    <table>
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
                <td class="actions-cell">
                    <a href="{{ route('places.show', $place) }}" class="action-link">Просмотр</a>
                    <a href="{{ route('places.edit', $place) }}" class="action-link">Редактировать</a>
                    <form method="POST" action="{{ route('places.destroy', $place) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="action-link" onclick="if(confirm('Точно удалить?')) this.closest('form').submit(); return false;">Удалить</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($places->hasPages())
        <div class="custom-pagination">
            {{ $places->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection