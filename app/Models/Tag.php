<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tag';
    protected $guarded = [];

    private $descendants = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
