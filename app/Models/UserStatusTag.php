<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserStatusTag extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user_status_tags';
    protected $guarded = [];

    private $descendants = [];
}
