<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'video_category';
    protected $guarded = [];

    private $descendants = [];
}
