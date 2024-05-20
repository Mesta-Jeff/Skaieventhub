<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApiToken extends Model
{
    protected $fillable = ['raw_token','user_key', 'user_id', 'hash_token', 'status'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }use HasFactory;
}
