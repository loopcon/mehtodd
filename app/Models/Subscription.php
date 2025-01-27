<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SubscriptionDescription;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'subscriptions';
    protected $guarded = [];

    private $descendants = [];

    public function subscriptionDescription()
    {
        return $this->hasMany(SubscriptionDescription::class);
    }
    public function subscriptionAccesses()
    {
        return $this->hasMany(SubscriptionAccess::class);
    }
}
