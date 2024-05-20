<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConcern extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'concern_type', 'concern', 'priority', 'token_id', 'status', 'teller_id', 'answer'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
