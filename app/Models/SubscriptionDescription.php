<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionDescription extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'subscriptions_description';
    protected $guarded = [];

    private $descendants = [];
}
