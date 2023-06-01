@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="date-table">
    <div class="date-table__heading">
        <h2>2021-11-01</h2>
        {{-- あとで修正 ここは、datetimeのformat修正して$date[]とかにする？ --}}
        {{-- ページネート？？ --}}
    </div>
    <table class="date-table__inner">
        <tr class="date-table__row">
            <th class="date-table__header">名前</th>
            <th class="date-table__header">勤務開始</th>
            <th class="date-table__header">勤務終了</th>
            <th class="date-table__header">休憩時間</th>
            <th class="date-table__header">勤務時間</th>
        </tr>
        <tr class="date-table__row">
            <td class="date-table__item">テスト太郎</td>
            <td class="date-table__item">10:00:00</td>
            <td class="date-table__item">20:00:00</td>
            <td class="date-table__item">00:30:00</td>
            <td class="date-table__item">09:30:00</td>
            {{-- ここはあとでforeach入れる --}}
        </tr>
    </table>
    {{-- ページネートする --}}
</div>
@endsection