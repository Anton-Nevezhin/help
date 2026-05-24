<?php

namespace App\Mail;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMeetingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;
    public $user;

    public function __construct(Meeting $meeting, User $user)
    {
        $this->meeting = $meeting;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Новое мероприятие: ' . ($this->meeting->event->name ?? 'Мероприятие'))
                    ->markdown('emails.new-meeting');
    }
}