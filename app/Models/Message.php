<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'content'];
    
    public function getCreatedAtAttribute($value)
    {
        $value = new \Carbon\Carbon($value);
        $value->setTimezone('GMT+1');
        if ($value->isToday()) {
            return date('h:i a', strtotime($value));
        } elseif ($value->isCurrentYear()) {
            return date('M d, h:i a', strtotime($value));
        } else {
            return date('M d, Y h:i a', strtotime($value));
        }
    }
}
