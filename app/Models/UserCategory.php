<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;
    protected $table = 'user_categories';
    protected $guarded = [];

    private $descendants = [];


    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
