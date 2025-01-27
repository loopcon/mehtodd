<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaliciousVideo extends Model
{
    use HasFactory;
    protected $table = 'malicious_videos';
    protected $fillable = ['video_id', 'report_by', 'description','reported_date'];
    protected $guarded = [];
    // public function videoes()
    // {
    //     return $this->hasMany(Video::class, 'id','video_id');
    // }
    
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id'); // Assuming 'video_id' is the foreign key
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'report_by');
    }
}
