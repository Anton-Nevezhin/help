<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Place;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = Meeting::with('place', 'event')
            ->orderBy('meeting_date')
            ->orderBy('meeting_time')
            ->paginate(10);
        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $places = Place::orderBy('name')->get();
        $events = Event::orderBy('name')->get();
        
        return view('meetings.create', compact('places', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $meeting = Meeting::create($request->all());

    // Отправка уведомлений в Telegram
    $users = User::whereNotNull('telegram_id')->get();
    $token = env('TELEGRAM_BOT_TOKEN');

    foreach ($users as $user) {
        // Проверка: ID должен состоять только из цифр и быть длиной 9-10 символов
        if (!preg_match('/^[0-9]{9,10}$/', $user->telegram_id)) {
            continue; // пропускаем некорректный ID
        }

        $message = "Новая программа!\n\n" .
                "Название: " . ($meeting->event->name ?? '—') . "\n" .
                "Место: " . ($meeting->place->name ?? '—') . "\n" .
                "Дата: {$meeting->meeting_date}\n" .
                "Время: {$meeting->meeting_time}\n" .
                "Примечание: {$meeting->note}";

        @file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$user->telegram_id}&text=" . urlencode($message));
    }

    return redirect()->route('admin.index')->with('success', 'Мероприятие создано');
}
    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return view('meetings.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        $places = Place::all();
        $events = Event::all();
        
        return view('meetings.edit', compact('meeting', 'places', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());
        return redirect()->route('admin.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('admin.index');
    }
}
