<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'day',
        'time_start',
        'time_end',
        'room'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
