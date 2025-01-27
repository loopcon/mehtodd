<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSlider extends Model
{
    use HasFactory;
    protected $table = 'user_sliders';
    protected $guarded = [];

    private $descendants = [];

    
    

}


