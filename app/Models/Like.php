<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'likes';
    protected $guarded = [];

    private $descendants = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }

}



