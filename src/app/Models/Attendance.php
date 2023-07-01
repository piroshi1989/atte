<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_time', 'end_time'];

    public function breakTimes()
    {
    return $this->hasMany(BreakTime::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getWorkDates()
    {
    return DB::table('attendances')
        ->selectRaw('DATE_FORMAT(start_time, "%Y-%m-%d") AS date')
        ->orderBy('date')
        ->get();
    }

    public function getStartTime()
    {
    return DB::table('attendances')
        ->selectRaw('DATE_FORMAT(start_time, "%h-%i-%s") AS start_time')
        ->get();
    }
}