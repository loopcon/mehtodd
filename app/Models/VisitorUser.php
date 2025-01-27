<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorUser extends Model
{
    use HasFactory;
    private $descendants = [];
    protected $guarded = [];

}
