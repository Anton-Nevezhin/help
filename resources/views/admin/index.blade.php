@extends('layouts.app')

@section('content')
<h1>Панель администратора</h1>

<a href="{{ route('meetings.create') }}">Добавить мероприятие</a>

<h2>Новости</h2>
@if($posts->count())
    <div id="postsList">
        @foreach($posts as $post)
            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <button class="editPostBtn" data-id="{{ $post->id }}">Редактировать</button>
                <button class="deletePostBtn" data-id="{{ $post->id }}">Удалить</button>
            </div>
        @endforeach
    </div>
@else
    <p>Нет новостей</p>
@endif

<button id="newPostBtn">Добавить новость</button>

<div id="postForm" style="display: none;">
    <h3>Добавить новость</h3>
    <input type="text" id="postTitle" placeholder="Заголовок" style="width: 100%;">
    <textarea id="postContent" rows="5" placeholder="Текст" style="width: 100%;"></textarea>
    <button id="savePostBtn">Сохранить</button>
    <button id="cancelPostBtn">Отмена</button>
</div>

<script>
    document.getElementById('newPostBtn').onclick = function() {
        document.getElementById('postForm').style.display = 'block';
        document.getElementById('postTitle').value = '';
        document.getElementById('postContent').value = '';
        document.querySelector('#postForm h3').innerText = 'Добавить новость';
        delete window.currentPostId;
    };

    document.getElementById('cancelPostBtn').onclick = function() {
        document.getElementById('postForm').style.display = 'none';
    };

    document.getElementById('savePostBtn').onclick = function() {
        const title = document.getElementById('postTitle').value;
        const content = document.getElementById('postContent').value;

        let url = '{{ route("admin.posts.store") }}';
        let method = 'POST';

        if (window.currentPostId) {
            url = '{{ route("admin.posts.update", "") }}/' + window.currentPostId;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ title: title, content: content })
        })
        .then(() => {
            location.reload();
        })
        .catch(err => alert('Ошибка: ' + err));
    };

    document.getElementById('postsList').addEventListener('click', function(e) {
        if (e.target.classList.contains('deletePostBtn')) {
            const id = e.target.getAttribute('data-id');
            if (confirm('Удалить новость?')) {
                fetch('{{ route("admin.posts.destroy", "") }}/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => location.reload());
            }
        }

        if (e.target.classList.contains('editPostBtn')) {
            const id = e.target.getAttribute('data-id');
            fetch('/admin/posts/' + id)
                .then(res => res.json())
                .then(post => {
                    document.getElementById('postTitle').value = post.title;
                    document.getElementById('postContent').value = post.content;
                    document.getElementById('postForm').style.display = 'block';
                    document.querySelector('#postForm h3').innerText = 'Редактировать новость';
                    window.currentPostId = id;
                });
        }
    });
</script>

<h2>Актуальные программы</h2>
@foreach($meetings as $meeting)
    <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <strong>Программа:</strong> {{ $meeting->event->name ?? '—' }}<br>
        <strong>Автор/Организатор:</strong> {{ $meeting->event->author ?? '—' }}<br>
        <strong>Описание программы:</strong> {{ $meeting->event->details ?? '—' }}<br>
        <strong>Примечание к программе:</strong> {{ $meeting->event->note ?? '—' }}<br>
        <strong>Площадка:</strong> {{ $meeting->place->name ?? '—' }}<br>
        <strong>Адрес площадки:</strong> {{ $meeting->place->address ?? '—' }}<br>
        <strong>Телефон площадки:</strong> {{ $meeting->place->phone ?? '—' }}<br>
        <strong>Дата:</strong> {{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }}<br>
        <strong>Время:</strong> {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}<br>
        <strong>Примечание к мероприятию:</strong> {{ $meeting->note ?: '—' }}
        
        <div style="margin-top: 10px;">
            <a href="{{ route('meetings.edit', $meeting) }}" class="btn-small">Редактировать</a>
            <form method="POST" action="{{ route('meetings.destroy', $meeting) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-small" onclick="return confirm('Удалить мероприятие?')">Удалить</button>
            </form>
        </div>
    </div>
@endforeach
@endsection