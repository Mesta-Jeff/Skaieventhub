<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function userOtpTokens()
    {
        return $this->hasMany(UserOtpToken::class);
    }

    public function userApiTokens()
    {
        return $this->hasMany(UserApiToken::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permission');
    }

    public function createdPermissions()
    {
        return $this->hasMany(UserPermission::class, 'creator_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function userTickets()
    {
        return $this->hasMany(UserTicket::class);
    }

    public function eventComments()
    {
        return $this->hasMany(EventComment::class);
    }

    public function eventLikes()
    {
        return $this->hasMany(EventLikes::class);
    }

    public function eventStars()
    {
        return $this->hasMany(EventStars::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','email','password', 'image', 'phone', 'dob', 'gender', 'two_factor_pin', 'two_factor_enabled','role_id','cover_image', 'nickname', 'fear', 'address', 'status','actions'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at', 'is_deleted', 'fear',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
