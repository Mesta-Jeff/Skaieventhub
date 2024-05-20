<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    protected $fillable = ['user_id', 'ticket_id', 'ticket_type', 'seat', 'ticket_no', 'qr_code', 'status', 'quantity'];

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
