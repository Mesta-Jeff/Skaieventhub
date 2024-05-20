<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'reason', 'amount', 'priority', 'token_id', 'status', 'teller_id', 'response'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
