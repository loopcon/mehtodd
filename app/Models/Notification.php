<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $guarded = [];

    private $descendants = [];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
