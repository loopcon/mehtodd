<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVideoCategory extends Model
{
    use HasFactory;
    protected $table = 'user_video_category';

    protected $guarded = [];
}


