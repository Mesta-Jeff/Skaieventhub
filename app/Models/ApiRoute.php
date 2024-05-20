<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiRoute extends Model
{
    protected $fillable = ['name', 'param','method', 'description', 'endpoint', 'status'];

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
