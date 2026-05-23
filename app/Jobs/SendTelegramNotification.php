<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTelegramNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $user;
    protected $meeting;

    public function __construct(User $user, Meeting $meeting)
    {
        $this->user = $user;
        $this->meeting = $meeting;
    }

    public function handle()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        
        if (!$token) {
            return;
        }

        if (!preg_match('/^[0-9]{9,10}$/', $this->user->telegram_id)) {
            return;
        }

        $message = "Новая программа!\n\n" .
                "Название: " . ($this->meeting->event->name ?? '—') . "\n" .
                "Место: " . ($this->meeting->place->name ?? '—') . "\n" .
                "Дата: {$this->meeting->meeting_date}\n" .
                "Время: {$this->meeting->meeting_time}\n" .
                "Примечание: {$this->meeting->note}";

        $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$this->user->telegram_id}&text=" . urlencode($message);
        
        $ctx = stream_context_create(['http' => ['timeout' => 5]]);
        @file_get_contents($url, false, $ctx);
    }
}