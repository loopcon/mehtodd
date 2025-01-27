<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AssignUser extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'assign_users';
    protected $guarded = [];

    private $descendants = [];
}
