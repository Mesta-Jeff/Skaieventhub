<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'package', 'price', 'status'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
