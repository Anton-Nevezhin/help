<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\Post;
use Carbon\Carbon; // убедись, что импорт есть в начале файла

class AdminController extends Controller
{

    public function index()
    {
    $posts = Post::latest()->get();

    $meetings = Meeting::whereDate('meeting_date', '>=', now()->toDateString())
        ->orderBy('meeting_date')
        ->orderBy('meeting_time')
        ->get();

    return view('admin.index', compact('posts', 'meetings'));
    }



    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $post = Post::create($validated);
        return response()->json($post);
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }

    public function getPost(Post $post)
    {
        return response()->json($post);
    }

    public function updatePost(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return response()->json($post);
    }



}
