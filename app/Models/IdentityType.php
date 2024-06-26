<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityType extends Model
{
    protected $fillable = ['name', 'status'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

}
