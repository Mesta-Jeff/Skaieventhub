<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandscapeAdvert extends Model
{
    protected $fillable = ['image', 'title', 'sub_title', 'description', 'verified', 'status','user_id'];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

}
