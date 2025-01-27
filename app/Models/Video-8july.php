<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';

    protected $guarded = [];

    private $descendants = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function usertag()
    {
        return $this->hasMany(UserTag::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function videoView()
    {
        return $this->hasMany(VideoView::class);
    }
    public function videoViewCount()
    {
        return $this->videoView()->get()->count();
    }
    public function privateVideoUsers()
    {
        return $this->hasMany(PrivateVideoUser::class);
    }
    public function userVideoShowOrNot()
    {
        $userIds = $this->privateVideoUsers()->get()->pluck('user_id')->toArray();
        $user_id = Auth::id();
        if ($user_id) {
            $userIds[] = $user_id;
        }
        if (in_array(Auth::id(), $userIds)) {
            return true;
        }
        return false;
    }
    public function selectedPrivateUserString()
    {
        $userIds = $this->privateVideoUsers()->get()->pluck('user_id')->toArray();
        $users = User::whereIn('id', $userIds)->pluck('displayname')->toArray();
        $userString = null;
        if (!is_null($users)) {
            $userString = implode(', ', $users);
        }
        return $userString;
    }
    public function isVideoPurchased()
    {
        $count = VideoAds::where('video_id', $this->id)->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function videoPurchased()
    {
        return $this->hasMany(VideoAds::class);
    }
}
