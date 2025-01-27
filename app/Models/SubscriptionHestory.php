<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionHestory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscription_hestory';
    protected $fillable = ['id', 'user_id', 'subsciption_id', 'amount', 'created_at', 'updated_at','deleted_at'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subsciption_id');
    }
}
