<x-mail::message>
# Здравствуйте, {{ $user->name }}!

Появилось новое мероприятие:

**{{ $meeting->event->name ?? '—' }}**

📍 **Место:** {{ $meeting->place->name ?? '—' }}  
📅 **Дата:** {{ \Carbon\Carbon::parse($meeting->meeting_date)->translatedFormat('d F Y') }}  
⏰ **Время:** {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}  

@if($meeting->note)
📌 **Примечание:** {{ $meeting->note }}
@endif

@if($meeting->event->details)
ℹ️ **Подробнее:** {{ $meeting->event->details }}
@endif

<x-mail::button :url="route('cabinet.index')">
Перейти в личный кабинет
</x-mail::button>

С уважением, команда {{ config('app.name') }}
</x-mail::message>