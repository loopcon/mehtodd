<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WorkStatus extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'work_statuses';
    protected $guarded = [];

    private $descendants = [];
}
