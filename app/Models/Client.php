<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'our_clients';

    protected $fillable = [
        'name',
        'degination',
        'description',
        'photo',


    ];
    private $descendants = [];
}
