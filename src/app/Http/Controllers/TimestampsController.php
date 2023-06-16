<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\BreakTime;
use Carbon\Carbon;

class TimestampsController extends Controller
{
    public function startWork(){
        $user = Auth::user();

        //最新レコードを取得してくる
        $oldAttendance = Attendance::where('user_id', $user->id)->latest()->first();


       //勤務開始がその日に押されていたらnew Carbon()で既存の出勤打刻時間、勤務開始日を取得
       if($oldAttendance){
            $oldAttendanceStartTime = new Carbon($oldAttendance->start_time);
            $oldAttendanceDay = $oldAttendanceStartTime->startOfDay();
       }else{
            $attendance = Attendance::create([
            'user_id' => $user->id,
            'start_time' => Carbon::now(),
            ]);

            return redirect('/start_worktime')->with('message', '勤務開始打刻が完了しました');
       }
        
        $newAttendanceDay = Carbon::today();
        
        //出勤打刻は1日1回、退勤打刻がされていないときのみ有効
        if($oldAttendanceDay == $newAttendanceDay){
            return redirect('/start_worktime')->with('error', '勤務開始打刻はすでにされています');
        }else{
            $attendance = Attendance::create([
            'user_id' => $user->id,
            'start_time' => Carbon::now(),
        ]);
            return redirect('/start_worktime')->with('message', '勤務開始打刻が完了しました');
        }
        }

    public function endWork(){
        $user = Auth::user();

        $oldAttendance = Attendance::where('user_id', $user->id)->latest()->first();
        $oldBreakTime = BreakTime::latest()->first();
        
        
        //勤務開始打刻が1度もされていないときは無効
       if(!$oldAttendance){
            return redirect('/end_worktime')->with('error', '勤務開始打刻がされていません');
       }

       //休憩終了していないときは無効
       if((!empty($oldBreakTime->start_time)) && (empty($oldBreakTime->end_time))){
            return redirect('/end_worktime')->with('error', '休憩終了打刻がされていません');
       }
       
        $oldAttendanceStartTime = new Carbon($oldAttendance->start_time);
        $oldAttendanceDay = $oldAttendanceStartTime->startOfDay();
        $newAttendanceDay = Carbon::today();
        
       //勤務終了打刻がすでにされている場合は無効
        if (!empty($oldAttendance->end_time)) {
        return redirect('/end_worktime')->with('error', 'すでに勤務終了打刻がされています');
        }
        
       //日付をまたぐ場合：old end_time, new start_time, new end_timeを入力
       if($oldAttendanceDay != $newAttendanceDay){
        $oldAttendance->update([
            'end_time' => $oldAttendanceDay->endOfDay()
        ]);
         $newAttendance= Attendance::create([
            'user_id' => $user->id,
            'start_time' => $newAttendanceDay,
            'end_time' => Carbon::now(),
        ]);

        return redirect('/end_worktime')->with('message', '勤務終了打刻が完了しました');
       }else{
        $oldAttendance->update([
        'end_time' => Carbon::now(),
        ]);
        return redirect('/end_worktime')->with('message', '勤務終了打刻が完了しました');
        }
    }

    public function startBreak(){
        $user = Auth::user();

        $oldAttendance = Attendance::latest()->first();
        $oldBreakTime = BreakTime::latest()->first();

        //休憩終了打刻が押されていなければ休憩開始は不可
        if($oldBreakTime && (empty($oldBreakTime->end_time))){
        return redirect('/start_breaktime')->with('error', '休憩終了打刻がされていません');
        }
        
        //業務終了打刻が押されていないときだけ休憩開始できる
        if($oldAttendance->start_time && empty($oldAttendance->end_time)){
         $newBreakTime= BreakTime::create([
            'user_id' => $user->id,
            'attendance_id' => $oldAttendance->id,
            'start_time' => Carbon::now(),
        ]);
        return redirect('/start_breaktime')->with('message', '休憩開始打刻が完了しました');
        }else{
        return redirect('/start_breaktime')->with('error', '勤務時間が終了しているので休憩は不可です');
        }
    }

    public function endBreak(){
        $user = Auth::user();

        $oldAttendance = Attendance::latest()->first();
        $oldBreakTime = BreakTime::latest()->first();

        //休憩開始打刻が押されていなければ不可
        if(empty($oldBreakTime->start_time)){
        return redirect('/end_breaktime')->with('error', '休憩開始打刻がされていません');
        }

        //休憩終了打刻は1回だけ
        if(!empty($oldBreakTime->end_time)){
        return redirect('/end_breaktime')->with('error', '休憩終了打刻はすでにされています。休憩をする場合は休憩開始打刻をしてください');
        }

       //日付をまたぐ場合：old end_time, new start_time, new end_timeを入力
        $oldAttendanceStartTime = new Carbon($oldAttendance->start_time);
        $oldAttendanceDay = $oldAttendanceStartTime->startOfDay();
        $newAttendanceDay = Carbon::today();
       
        $oldBreakStartTime = new Carbon($oldBreakTime->start_time);
        $oldBreakTimeDay = $oldBreakStartTime->startOfDay();
        $newBreakTimeDay = Carbon::today();
        
       if(($oldBreakTimeDay != $newBreakTimeDay) && empty($oldBreakTime->end_time)){
        //oldBreakTimeのend_timeを23:59で入力
        //oldAttendanceTimeのend_timeを23:59で入力
        $oldBreakTime->update([
            'end_time' => $oldBreakTimeDay->endOfDay()
        ]);
        $oldAttendance->update([
            'end_time' => $oldAttendanceDay->endOfDay()
        ]);
        
        //newAttendanceを作成
        $newAttendance= Attendance::create([
            'user_id' => $user->id,
            'start_time' => $newAttendanceDay,
        ]);
        //newBreakTimeを作成
        $newBreakTime= BreakTime::create([
            'user_id' => $user->id,
            'attendance_id' => $newAttendance->id,
            'start_time' => $newAttendanceDay,
            'end_time' => Carbon::now(),
        ]);

        return redirect('/end_worktime')->with('message', '休憩終了打刻が完了しました');
        
       }else{
            $oldBreakTime->update([
            'end_time' => Carbon::now(),
            ]);
            //日付をまたがない場合はそのままend_timeに入力
        return redirect('/end_worktime')->with('message', '休憩終了打刻が完了しました');
       }
    }
}