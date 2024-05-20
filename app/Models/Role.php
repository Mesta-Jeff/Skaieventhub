<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
