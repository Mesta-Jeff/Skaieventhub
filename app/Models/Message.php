<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'sender_id', 'referenced_message_id', 'status'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
