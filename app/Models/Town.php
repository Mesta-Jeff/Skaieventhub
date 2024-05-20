<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['district_id', 'name', 'status'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
