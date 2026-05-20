<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['place_id', 'event_id', 'meeting_date', 'meeting_time', 'note'];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
