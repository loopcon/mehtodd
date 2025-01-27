<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\SubscriptionHestory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $guarded = [];

    private $descendants = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    public function videocategory()
    {
        return $this->belongsTo(VideoCategory::class, 'category_name', 'id');
    }

    public function user_documents()
    {
        return $this->hasMany(UserDocument::class);
    }

    public function userSlider()
    {
        return $this->hasMany(UserSlider::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function profileAds()
    {
        return $this->hasMany(ProfileAds::class, 'user_id', 'id');
    }

    public function subscriptionHistory()
    {
        return $this->hasOne(SubscriptionHestory::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    
}

/**
 * The attributes that should be cast.
 *
 * @var array<string, string>
 */
