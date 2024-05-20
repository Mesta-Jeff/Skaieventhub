<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'ticket_id', 'amount', 'acc_number', 'acc_host', 'status', 'ipaddress','ref_number'];

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
