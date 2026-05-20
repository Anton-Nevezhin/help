<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/telegram/set-id', function (Request $request) {
    $user = User::find($request->user_id);
    if ($user && !$user->telegram_id) {
        $user->telegram_id = $request->chat_id;
        $user->save();
    }
    return response()->json(['status' => 'ok']);
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
