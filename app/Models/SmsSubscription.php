<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsSubscription extends Model
{
    use HasFactory;
    protected $fillable = ['author_id', 'event_id', 'package_id', 'status'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
