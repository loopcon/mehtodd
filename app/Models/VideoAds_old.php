<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoAds extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'video_ads';
    protected $guarded = [];
    private $descendants = [];
}
