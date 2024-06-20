<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    protected $fillable = ['ticket_type', 'user_id', 'ticket_id', 'quantity', 'seat', 'ticket_no', 'status'];


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
