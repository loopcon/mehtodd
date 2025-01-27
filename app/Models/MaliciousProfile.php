<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaliciousProfile extends Model
{
    use HasFactory;
    protected $table = 'malicious_profiles';
    protected $fillable = ['user_id', 'report_by', 'descriptions','reported_date'];
    protected $guarded = [];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'report_by');
    }
}
