<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class AttendanceController extends Controller
{
    public function attendanceView(){

        $attendanceRecords = Attendance::with('breakTimes')->latest()->get();
        //昇順に並べ替えて取得

        $groupedRecords = $attendanceRecords->groupBy(function ($record) {
        $carbonDate = Carbon::parse($record->start_time);
            return $carbonDate->format('Y-m-d');
        });
        
        $formattedRecords = $groupedRecords->map(function ($records, $date) {
            return [
                'date' => $date,
                'records' => $records->map(function ($record) {
                    $start = Carbon::parse($record->start_time);
                    $end = Carbon::parse($record->end_time);
                    //勤務の開始時間、終了時間のインスタンスを作成

                    $totalBreakTime = $record->breakTimes->sum(function ($breakTime) {
                    $start = Carbon::parse($breakTime->start_time);
                    $end = Carbon::parse($breakTime->end_time);
                        return $start->diffInSeconds($end);
                    });
                     //休憩の開始時間、終了時間のインスタンスを作成し、差分を秒で返す

                    $totalAttendanceTime = $end->diffInSeconds($start) - $totalBreakTime;
                    //勤務終了と開始の差分を求め、そこから休憩時間を引く
                    
                    $hours = floor($totalBreakTime / 3600);
                    $minutes = floor(($totalBreakTime % 3600) / 60);
                    $seconds = $totalBreakTime % 60;
                    //差分は数値になっているため00:00:00の形に整える
                    $formattedTotalBreakTime = sprintf ('%02d:%02d:%02d', $hours, $minutes, $seconds);

                    $hours = floor($totalAttendanceTime / 3600);
                    $minutes = floor(($totalAttendanceTime % 3600) / 60);
                    $seconds = $totalAttendanceTime % 60;
                    //差分は数値になっているため00:00:00の形に整える
                    $formattedTotalAttendanceTime = sprintf ('%02d:%02d:%02d', $hours, $minutes, $seconds);
            
                    return [
                        'name' => $record->user->name,
                        'start_time' => Carbon::parse($record->start_time)->format('H:i:s'),
                        'end_time' => $record->end_time ? Carbon::parse($record->end_time)->format('H:i:s') : '00:00:00',
                        //end_timeが入力されていないときは00:00:00を表示
                        'total_break_time' => $formattedTotalBreakTime,
                        'total_attendance_time'=> $formattedTotalAttendanceTime,
                        // 他の属性のフォーマットも追加
            ];
        })->paginate($perPage = 5, $pageName = 'records'),
    ];
})->simplePaginate(
    $perPage = 1, $pageName = 'dates');


    
    return view('attendance', compact('formattedRecords'));
}
}