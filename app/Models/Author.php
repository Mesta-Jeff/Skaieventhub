<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'title', 'initials', 'region_id', 'district_id', 'town_id', 'first_name', 'last_name',
        'gender', 'dob', 'phone', 'tel', 'identity_type_id', 'id_number', 'id_scan', 'email',
        'acc_owner', 'acc_num', 'account_type', 'acc_host', 'acc_branch', 'profile', 'status',
        'verified', 'approved'
    ];


    
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function identityType()
    {
        return $this->belongsTo(IdentityType::class);
    }
}
