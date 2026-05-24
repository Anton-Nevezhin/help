<?php

namespace App\Jobs;

use App\Mail\NewMeetingMail;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $meeting;
    protected $user;

    public function __construct(Meeting $meeting, User $user)
    {
        $this->meeting = $meeting;
        $this->user = $user;
    }

    public function handle()
    {
        if ($this->user->email) {
            Mail::to($this->user->email)->send(new NewMeetingMail($this->meeting, $this->user));
        }
    }
}