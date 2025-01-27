<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ProfileAds extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'profile_ads';
    protected $guarded = [];
    private $descendants = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
