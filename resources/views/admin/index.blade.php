@extends('layouts.app')

@section('content')

<div class="admin-header">
    <a href="{{ route('meetings.create') }}" class="btn">Добавить мероприятие</a>
    <button id="newPostBtn" class="btn">Добавить новость</button>
</div>

@if($posts->count())
    <div id="postsList">
        @foreach($posts as $post)
            <div class="card-news">
                <div class="post-title" style="font-weight: bold; font-size: 22px;">{{ $post->title }}</div>
                <div>{{ $post->content }}</div>
                <button class="editPostBtn btn-small" data-id="{{ $post->id }}">Редактировать</button>
                <button class="deletePostBtn btn-small" data-id="{{ $post->id }}">Удалить</button>
            </div>
        @endforeach
    </div>
@endif

<div id="postForm" style="display: none;">
    <div class="form-title" style="font-weight: bold; font-size: 24px; margin-bottom: 15px;">Добавить новость</div>
    <input type="text" id="postTitle" placeholder="Заголовок" style="width: 100%; margin-bottom: 10px;">
    <textarea id="postContent" rows="5" placeholder="Текст" style="width: 100%; margin-bottom: 10px;"></textarea>
    <button id="savePostBtn" class="btn">Сохранить</button>
    <button id="cancelPostBtn" class="btn">Отмена</button>
</div>

<script>
    document.getElementById('newPostBtn').onclick = function() {
        document.getElementById('postForm').style.display = 'block';
        document.getElementById('postTitle').value = '';
        document.getElementById('postContent').value = '';
        document.querySelector('#postForm .form-title').innerText = 'Добавить новость';
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
                    document.querySelector('#postForm .form-title').innerText = 'Редактировать новость';
                    window.currentPostId = id;
                });
        }
    });
</script>

@foreach($meetings as $meeting)
    <div class="card-meeting">
        @if($meeting->place->name)
            <div class="place-name">{{ $meeting->place->name }}</div>
        @endif
        @if($meeting->place->address)
            <div>{{ $meeting->place->address }}</div>
        @endif
        @if($meeting->place->phone)
            <div>{{ $meeting->place->phone }}</div>
        @endif
        @if($meeting->event->name)
            <div class="event-name">{{ $meeting->event->name }}</div>
        @endif
        @if($meeting->event->author)
            <div>{{ $meeting->event->author }}</div>
        @endif
        @if($meeting->event->details)
            <div>{{ $meeting->event->details }}</div>
        @endif
        @if($meeting->event->note)
            <div>{{ $meeting->event->note }}</div>
        @endif
        <div class="meeting-datetime">{{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }} в {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}</div>
        @if($meeting->note)
            <div>{{ $meeting->note }}</div>
        @endif
        <div style="margin-top: 15px;">
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