<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'purpose', 'sender_id', 'receiver_id', 'status'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
