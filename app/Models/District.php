<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['region_id', 'name', 'status'];

    
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function towns()
    {
        return $this->hasMany(Town::class);
    }
}
