<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['event_id', 'price', 'total', 'seat', 'remaining', 'description', 'status', 'user_id', 'title'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
