@extends('layouts.app')

@section('content')

<div class="form-card">
    <h1>Новая встреча</h1>

    <form method="POST" action="{{ route('meetings.store') }}">
        @csrf

        <div class="form-group">
            <label>Площадка:</label>
            <select name="place_id" id="place_id" required>
                <option value="">-- Выберите площадку --</option>
                @foreach($places as $place)
                    <option value="{{ $place->id }}">{{ $place->name }}</option>
                @endforeach
            </select>
            <button type="button" id="quickPlaceBtn" class="btn-small" style="margin-top: 10px;">Новая площадка</button>
        </div>

        <div class="form-group">
            <label>Программа:</label>
            <select name="event_id" id="event_id" required>
                <option value="">-- Выберите программу --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
            <button type="button" id="quickEventBtn" class="btn-small" style="margin-top: 10px;">Новая программа</button>
        </div>

        <div class="form-group">
            <label>Дата:</label>
            <input type="date" name="meeting_date" required>
        </div>

        <div class="form-group">
            <label>Время:</label>
            <input type="time" name="meeting_time" required>
        </div>

        <div class="form-group">
            <label>Примечание:</label>
            <textarea name="note" rows="3"></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Создать встречу</button>
            <a href="{{ route('meetings.index') }}" class="btn">Отмена</a>
        </div>
    </form>
</div>

<!-- Форма быстрого добавления площадки -->
<div id="quickPlaceForm" style="display: none;" class="form-card" style="margin-top: 20px;">
    <h3>Быстрое добавление площадки</h3>
    <input type="text" id="newPlaceName" placeholder="Название площадки" class="form-input">
    <input type="text" id="newPlaceAddress" placeholder="Адрес" class="form-input">
    <input type="text" id="newPlacePhone" placeholder="Телефон" class="form-input">
    <div class="form-actions">
        <button type="button" id="saveQuickPlace" class="btn">Сохранить</button>
        <button type="button" id="cancelQuickPlace" class="btn">Отмена</button>
    </div>
</div>

<!-- Форма быстрого добавления программы -->
<div id="quickEventForm" style="display: none;" class="form-card" style="margin-top: 20px;">
    <h3>Быстрое добавление программы</h3>
    <input type="text" id="newEventName" placeholder="Название программы" class="form-input">
    <input type="text" id="newEventAuthor" placeholder="Автор/Организатор" class="form-input">
    <textarea id="newEventDetails" placeholder="Описание" class="form-input" rows="3"></textarea>
    <textarea id="newEventNote" placeholder="Примечание" class="form-input" rows="2"></textarea>
    <div class="form-actions">
        <button type="button" id="saveQuickEvent" class="btn">Сохранить</button>
        <button type="button" id="cancelQuickEvent" class="btn">Отмена</button>
    </div>
</div>

<script>
    document.getElementById('quickPlaceBtn').onclick = function() {
        document.getElementById('quickPlaceForm').style.display = 'block';
    };
    document.getElementById('cancelQuickPlace').onclick = function() {
        document.getElementById('quickPlaceForm').style.display = 'none';
    };
    document.getElementById('saveQuickPlace').onclick = function() {
        let name = document.getElementById('newPlaceName').value;
        let address = document.getElementById('newPlaceAddress').value;
        let phone = document.getElementById('newPlacePhone').value;
        if (!name || !address) {
            alert('Название и адрес обязательны');
            return;
        }
        fetch('{{ route("quick.place") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: name, address: address, phone: phone })
        })
        .then(response => response.json())
        .then(data => {
            if (data.id) {
                let select = document.getElementById('place_id');
                let option = new Option(data.name, data.id);
                select.add(option);
                select.value = data.id;
                document.getElementById('quickPlaceForm').style.display = 'none';
                document.getElementById('newPlaceName').value = '';
                document.getElementById('newPlaceAddress').value = '';
                document.getElementById('newPlacePhone').value = '';
            } else {
                alert('Ошибка: ' + (data.message || 'Не удалось добавить площадку'));
            }
        })
        .catch(error => console.error('Error:', error));
    };
    document.getElementById('quickEventBtn').onclick = function() {
        document.getElementById('quickEventForm').style.display = 'block';
    };
    document.getElementById('cancelQuickEvent').onclick = function() {
        document.getElementById('quickEventForm').style.display = 'none';
    };
    document.getElementById('saveQuickEvent').onclick = function() {
        let name = document.getElementById('newEventName').value;
        let author = document.getElementById('newEventAuthor').value;
        let details = document.getElementById('newEventDetails').value;
        let note = document.getElementById('newEventNote').value;
        if (!name) {
            alert('Название программы обязательно');
            return;
        }
        fetch('{{ route("quick.event") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: name, author: author, details: details, note: note })
        })
        .then(response => response.json())
        .then(data => {
            if (data.id) {
                let select = document.getElementById('event_id');
                let option = new Option(data.name, data.id);
                select.add(option);
                select.value = data.id;
                document.getElementById('quickEventForm').style.display = 'none';
                document.getElementById('newEventName').value = '';
                document.getElementById('newEventAuthor').value = '';
                document.getElementById('newEventDetails').value = '';
                document.getElementById('newEventNote').value = '';
            } else {
                alert('Ошибка: ' + (data.message || 'Не удалось добавить программу'));
            }
        })
        .catch(error => console.error('Error:', error));
    };
</script>

@endsection