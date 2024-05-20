<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['logo', 'image', 'title', 'content', 'message', 'description', 'type'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

}
