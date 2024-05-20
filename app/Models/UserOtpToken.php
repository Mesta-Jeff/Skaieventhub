<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtpToken extends Model
{
    protected $fillable = ['token', 'status', 'user_id'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
