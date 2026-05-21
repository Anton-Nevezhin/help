<!DOCTYPE html>
<html>
<head>
    <title>Новая встреча</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input, textarea { width: 100%; max-width: 400px; padding: 5px; }
        button { padding: 8px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; margin-top: 5px; }
        .quick-form { display: none; margin-top: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; }
    </style>
</head>
<body>
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
            <button type="button" id="quickPlaceBtn">Новая площадка</button>
        </div>

        <div class="form-group">
            <label>Программа:</label>
            <select name="event_id" id="event_id" required>
                <option value="">-- Выберите программу --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
            <button type="button" id="quickEventBtn">Новая программа</button>
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
            <textarea name="note"></textarea>
        </div>

        <button type="submit">Создать встречу</button>
        <a href="{{ route('meetings.index') }}">Отмена</a>
    </form>

    <!-- Форма быстрого добавления площадки-->
    <div id="quickPlaceForm" class="quick-form">
        <h3>Быстрое добавление площадки</h3>
        <input type="text" id="newPlaceName" placeholder="Название площадки" required>
        <input type="text" id="newPlaceAddress" placeholder="Адрес" required>
        <input type="text" id="newPlacePhone" placeholder="Телефон">
        <button id="saveQuickPlace">Сохранить</button>
        <button id="cancelQuickPlace">Отмена</button>
    </div>

    <!-- Форма быстрого добавления программы -->
    <div id="quickEventForm" class="quick-form">
        <h3>Быстрое добавление программы</h3>
        <input type="text" id="newEventName" placeholder="Название программы" required>
        <input type="text" id="newEventAuthor" placeholder="Автор/Организатор">
        <textarea id="newEventDetails" placeholder="Описание"></textarea>
        <textarea id="newEventNote" placeholder="Примечание"></textarea>
        <button id="saveQuickEvent">Сохранить</button>
        <button id="cancelQuickEvent">Отмена</button>
    </div>

    <script>
        // Показать форму добавления площадки
        document.getElementById('quickPlaceBtn').onclick = function() {
            document.getElementById('quickPlaceForm').style.display = 'block';
        };
        document.getElementById('cancelQuickPlace').onclick = function() {
            document.getElementById('quickPlaceForm').style.display = 'none';
        };

        // AJAX для площадки
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

        // Показать форму добавления программы
        document.getElementById('quickEventBtn').onclick = function() {
            document.getElementById('quickEventForm').style.display = 'block';
        };
        document.getElementById('cancelQuickEvent').onclick = function() {
            document.getElementById('quickEventForm').style.display = 'none';
        };

        // AJAX для программы
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
</body>
</html>