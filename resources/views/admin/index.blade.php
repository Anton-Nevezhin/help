@extends('layouts.app')

@section('content')
<h1>Панель администратора</h1>

<a href="{{ route('meetings.create') }}">Добавить мероприятие</a>

<h2>Новости</h2>
@if($posts->count())
    <div id="postsList">
        @foreach($posts as $post)
            <div>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <button class="editPostBtn" data-id="{{ $post->id }}">Редактировать</button>
                <button class="deletePostBtn" data-id="{{ $post->id }}">Удалить</button>
                <hr>
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
    // Показать форму добавления
    document.getElementById('newPostBtn').onclick = function() {
        document.getElementById('postForm').style.display = 'block';
        document.getElementById('postTitle').value = '';
        document.getElementById('postContent').value = '';
        document.querySelector('#postForm h3').innerText = 'Добавить новость';
        delete window.currentPostId;
    };

    // Скрыть форму
    document.getElementById('cancelPostBtn').onclick = function() {
        document.getElementById('postForm').style.display = 'none';
    };

    // Сохранение (добавление или редактирование)
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

    // Обработка удаления и открытия редактирования
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
    <div>
        {{ $meeting->event->name ?? '—' }} – {{ $meeting->place->name ?? '—' }},
        {{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }}
        в {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}
        
        <div style="margin-top: 5px;">
            <a href="{{ route('meetings.edit', $meeting) }}" class="btn-small">Редактировать</a>
            <form method="POST" action="{{ route('meetings.destroy', $meeting) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-small" onclick="return confirm('Удалить мероприятие?')">Удалить</button>
            </form>
        </div>
        <hr>
    </div>
@endforeach
@endsection