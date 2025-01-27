<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoSport extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'video_sports';
    protected $guarded = [];
    private $descendants = [];



    public function UserVideoSport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
}
