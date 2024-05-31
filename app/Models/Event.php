<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_title', 'sub_title', 'content', 'creator_id', 'views', 'stars', 'comments', 'description',
        'reason', 'event_type_id', 'start_date', 'end_date', 'aliases', 'venue', 'banner',
        'large_image', 'medium_image', 'small_image', 'promo_video', 'status', 'verified', 'approved'
    ];

    protected $hidden = [
        'updated_at','is_deleted'
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(EventComment::class);
    }

    public function likes()
    {
        return $this->hasMany(EventLikes::class);
    }

    public function stars()
    {
        return $this->hasMany(EventStars::class);
    }
}
