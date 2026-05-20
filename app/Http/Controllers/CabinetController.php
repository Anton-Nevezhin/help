<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Post;

class CabinetController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $posts = Post::latest()->get(); // все новости

        $meetings = Meeting::whereDate('meeting_date', '>=', now()->toDateString())
            ->orderBy('meeting_date')
            ->orderBy('meeting_time')
            ->get();

        return view('cabinet.index', compact('posts', 'meetings'));
    }

    public function updateNotifications(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'telegram_id' => 'nullable|string',
            'whatsapp_phone' => 'nullable|string',
            'vk_id' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('cabinet.index')->with('success', 'Настройки сохранены');
    }
}