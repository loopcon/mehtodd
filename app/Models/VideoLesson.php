<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoLesson extends Model
{
    use HasFactory;
    protected $table = 'video_lessons';
    protected $guarded = [];
    private $descendants = [];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
