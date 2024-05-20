<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;
    protected $fillable = ['author_id', 'reason', 'amount', 'priority', 'balance_before', 'balance_after', 'token_id', 'status', 'teller_id', 'response'];
    protected $hidden = ['updated_at', 'is_deleted'];
}
