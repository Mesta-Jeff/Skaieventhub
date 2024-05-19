<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
