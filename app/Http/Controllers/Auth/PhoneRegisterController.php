<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PhoneRegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.phone-register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = User::where('phone', $request->phone)->first();
        
        if (!$user) {
            return back()->withErrors(['phone' => 'Телефон не найден. Обратитесь к администратору.']);
        }
        
        if ($user->is_registered) {
            return back()->withErrors(['phone' => 'Этот телефон уже зарегистрирован. Войдите в систему.']);
        }
        
        $user->password = Hash::make($request->password);
        $user->is_registered = true;
        $user->save();
        
        auth()->login($user);
        
        return redirect()->route('cabinet.index');
    }
}