<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventManager extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'user_id', 'status'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
