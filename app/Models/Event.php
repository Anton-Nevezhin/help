<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'author', 'details', 'note'];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
