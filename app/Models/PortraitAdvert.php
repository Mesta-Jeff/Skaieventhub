<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortraitAdvert extends Model
{
    protected $fillable = ['image', 'title', 'sub_title', 'description', 'verified', 'status', 'user_id'];

}
