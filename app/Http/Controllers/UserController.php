<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http; 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Сохранить нового участника
     */
    public function store(Request $request)
    {
        // 1. Проверяем данные из формы
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'telegram_id' => 'nullable|string|regex:/^[0-9]{9,10}$/',
            'whatsapp_phone' => 'nullable|string',
            'vk_id' => 'nullable|string',
        ], [
            'telegram_id.regex' => 'Telegram ID должен содержать 9-10 цифр',
        ]);

        // 2. Генерируем случайный пароль (8 символов)
        $randomPassword = Str::random(8);

        // 3. Добавляем недостающие поля
        $validated['role'] = 'user';                        // роль всегда 'user'
        $validated['password'] = bcrypt($randomPassword);   // пароль хешируем
        $validated['email'] = $validated['email'] ?? null;  // если email не заполнен — будет null

        // 4. Создаём участника в БД
        $user = User::create($validated);

        // 5. Отправляем пароль в SMS
    //    $this->sendSms($request->phone, "Ваш пароль для входа: {$randomPassword}");

    return redirect()->route('users.index')->with('success', 'Участник создан. Пароль: ' . $randomPassword);

        // 6. Возвращаемся к списку участников с сообщением
        return redirect()->route('users.index')->with('success', 'Участник создан. Пароль отправлен в SMS.');
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'telegram_id' => 'nullable|string|regex:/^[0-9]{9,10}$/',
            'whatsapp_phone' => 'nullable|string',
            'vk_id' => 'nullable|string',
            'role' => 'required|in:user,admin',
        ], [
            'telegram_id.regex' => 'Telegram ID должен содержать 9-10 цифр',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Участник обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
            // Запрещаем администратору удалять самого себя
            if ($user->id === auth()->id()) {
                return redirect()->route('users.index')->with('error', 'Нельзя удалить самого себя');
            }

            $user->delete();
            return redirect()->route('users.index')->with('success', 'Участник удалён');
    }
}
