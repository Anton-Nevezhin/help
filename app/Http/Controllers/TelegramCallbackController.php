<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramCallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        $authData = $request->all();
        $botToken = env('TELEGRAM_BOT_TOKEN');
        
        // Проверка подписи
        $checkHash = $authData['hash'];
        unset($authData['hash']);
        ksort($authData);
        
        $dataCheckString = [];
        foreach ($authData as $key => $value) {
            $dataCheckString[] = $key . '=' . $value;
        }
        $dataCheckString = implode("\n", $dataCheckString);
        
        $secretKey = hash('sha256', $botToken, true);  // ИСПРАВЛЕНО
        $hash = hash_hmac('sha256', $dataCheckString, $secretKey);
        
        if (strcmp($hash, $checkHash) !== 0) {
            return redirect()->route('cabinet.index')->with('error', 'Неверные данные Telegram');
        }
        
        // Сохраняем Telegram ID
        $user = auth()->user();
        $user->telegram_id = $authData['id'];
        $user->save();
        
        return redirect()->route('cabinet.index')->with('success', 'Telegram успешно привязан!');
    }
}