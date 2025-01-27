<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfessionalDetail extends Model
{
    use HasFactory;
    protected $table = 'user_professional_details';
    protected $guarded = [];

    private $descendants = [];
}
