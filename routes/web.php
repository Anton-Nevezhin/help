<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
        return redirect()->route('cabinet.index');
    }
    return redirect()->route('login');
});

Route::get('/register-phone', [App\Http\Controllers\Auth\PhoneRegisterController::class, 'showForm'])->name('register.phone');
Route::post('/register-phone', [App\Http\Controllers\Auth\PhoneRegisterController::class, 'register']);

Route::get('/test-mail', function () {
    Mail::raw('Тестовое письмо', function ($message) {
        $message->to('test@example.com')->subject('Проверка');
    });
    return 'Письмо отправлено. Проверь Mailpit на http://localhost:8025';
});

// Маршруты для аутентификации (Breeze)
require __DIR__.'/auth.php';

// Защищённые маршруты (только после входа)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Твои маршруты
    Route::resource('places', PlaceController::class);
    Route::resource('events', EventController::class);
    Route::resource('meetings', MeetingController::class);
    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class);

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet.index');
    Route::put('/cabinet', [CabinetController::class, 'updateNotifications'])->name('cabinet.update');

    // AJAX для новостей в админке
    Route::post('/admin/posts', [AdminController::class, 'storePost'])->name('admin.posts.store');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');
    Route::get('/admin/posts/{post}', [AdminController::class, 'getPost'])->name('admin.posts.get');
    Route::put('/admin/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.posts.update');

    // Быстрое создание (для площадок и программ)
    Route::post('/quick/place', [PlaceController::class, 'quickStore'])->name('quick.place');
    Route::post('/quick/event', [EventController::class, 'quickStore'])->name('quick.event');

    Route::get('/telegram-callback', [App\Http\Controllers\TelegramCallbackController::class, '__invoke'])->name('telegram.callback')->middleware('auth');
    
});