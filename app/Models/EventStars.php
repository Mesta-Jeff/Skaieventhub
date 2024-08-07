<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStars extends Model
{
    protected $fillable = ['user_id', 'event_id', 'status'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
