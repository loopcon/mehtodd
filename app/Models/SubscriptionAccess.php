<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionAccess extends Model
{
    use HasFactory, SoftDeletes;

    public function module()
    {
        return $this->belongsTo(Module::class,'module_id','id');
    }
    public function getModuleNames()
    {
        return $this->module();
    }
}
