<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    use HasFactory;
    public $fillable = ['name', 'is_private', 'user_id'];

    public function privateUsers()
    {
        return $this->hasMany(PrivateLessonUser::class);
    }
    public function videos()
    {
        return $this->hasMany(VideoLesson::class, 'lesson_id');
    }
    public function userLessonShowOrNot()
    {
        $userIds = $this->privateUsers()->get()->pluck('user_id')->toArray();
        $user_id = Auth::id();
        if ($user_id) {
            $userIds[] = $user_id;
        }
        if (in_array(Auth::id(), $userIds)) {
            return true;
        }
        return false;
    }



}
