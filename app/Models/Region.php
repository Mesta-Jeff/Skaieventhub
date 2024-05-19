<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'status'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
