<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCalender extends Model
{
    use HasFactory;
    protected $table = 'user_calender';
    protected $guarded = [];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function meetingUser()
    {
        return $this->belongsTo(MeetingUser::class, 'id', 'user_calender_id');
    }
}
