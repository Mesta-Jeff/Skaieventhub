<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtpToken extends Model
{
    protected $fillable = ['token', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
