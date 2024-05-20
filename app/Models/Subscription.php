<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'acc_number', 'ref_number', 'acc_host', 'ipaddress', 'reason', 'status'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
