<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLike extends Model
{
    use HasFactory;
    protected $guarded = [];
    private $descendants = [];

    public function Professional()
{
    return $this->belongsTo(User::class, 'professional_id');
}
}
