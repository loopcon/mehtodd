<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTag extends Model
{
    use HasFactory ,SoftDeletes;
    protected $table = 'users_tags';

    protected $guarded = [];
    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
    public function Usertag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
