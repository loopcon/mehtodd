<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePage extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'homepage_settings';
    protected $guarded = [];

    private $descendants = [];}
