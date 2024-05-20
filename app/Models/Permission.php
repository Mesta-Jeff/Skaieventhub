<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = ['title', 'role_id', 'description', 'status', 'keys'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permission');
    }
}
